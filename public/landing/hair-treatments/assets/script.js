function makeSwiper(e){return new Swiper(e,{slidesPerView:1,spaceBetween:16,allowTouchMove:!0,simulateTouch:!0,grabCursor:!0,breakpoints:{640:{slidesPerView:2,spaceBetween:20},992:{slidesPerView:3,spaceBetween:24}}})}!function(){let e=document.getElementById("yr");e&&(e.textContent=new Date().getFullYear())}(),function(){let e=document.getElementById("hamb"),t=document.getElementById("mnav");function l(e){let l="boolean"==typeof e?e:t&&"block"!==t.style.display;t&&(t.style.display=l?"block":"none")}e&&e.addEventListener("click",()=>l()),window.toggleMenu=l}(),document.querySelectorAll(".tabbar .pill").forEach(e=>{e.addEventListener("click",()=>{document.querySelectorAll(".tabbar .pill").forEach(e=>e.classList.remove("active")),e.classList.add("active"),document.querySelectorAll(".tabp").forEach(e=>e.style.display="none");let t=document.getElementById(e.dataset.tab);t&&(t.style.display="block")})}),document.querySelectorAll(".faq-item .faq-q").forEach(e=>{e.addEventListener("click",()=>e.parentElement.classList.toggle("open"))});
document.addEventListener('DOMContentLoaded',()=>{
  const res=makeSwiper('#resultsSwiper');
  const trt=makeSwiper('#treatSwiper');
  const doc=makeSwiper('#docSwiper');
  const vid=makeSwiper('#videoSwiper');
  const rev=makeSwiper('#revSwiper');
  const bind=(id,fn)=>{const el=document.getElementById(id);if(el)el.addEventListener('click',fn);};
  bind('resultsPrev',()=>res.slidePrev()); bind('resultsNext',()=>res.slideNext());
  bind('treatPrev',()=>trt.slidePrev());   bind('treatNext',()=>trt.slideNext());
  bind('docPrev',()=>doc.slidePrev());     bind('docNext',()=>doc.slideNext());
  bind('vidPrev',()=>vid.slidePrev());     bind('vidNext',()=>vid.slideNext());
  bind('revPrev',()=>rev.slidePrev());     bind('revNext',()=>rev.slideNext());
});

/* Video thumbs */
function restoreThumb(el){
  const id=el.dataset.video;
  el.innerHTML=`<img src="https://img.youtube.com/vi/${id}/hqdefault.jpg" alt="Testimonial"><div class="play-yt"></div>`;
  el.classList.remove('playing');
}
document.querySelectorAll('.vthumb').forEach(el=>{
  el.addEventListener('click',()=>{
    if(el.classList.contains('playing'))return;
    document.querySelectorAll('.vthumb.playing').forEach(other=>restoreThumb(other));
    const id=el.dataset.video;
    el.innerHTML=`<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${id}?autoplay=1&modestbranding=1&rel=0&playsinline=1" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>`;
    el.classList.add('playing');
  });
});

/* ===== Cost Calculator modal logic ===== */
(function(){
  const modal=document.getElementById('calcModal');
  if(!modal) return;
  const openBtn=document.getElementById('openCalc');
  const closeBtn=document.getElementById('closeCalc');
  const closeDone=document.getElementById('closeDone');
  const getFreeAssementBtn = document.getElementById('get-free-assement-btn');
const getFreeAssementBtn1 = document.getElementById('get-free-assement-btn1');
const getFreeAssementBtn2 = document.getElementById('get-free-assement-btn2');
const getFreeAssementBtn3 = document.getElementById('get-free-assement-btn3');

  const steps=['step1','step2','step3','step4'].map(id=>document.getElementById(id));
  let selectedStage=null;

  const nameEl=document.getElementById('ccName');
  const phoneEl=document.getElementById('ccPhone');
  const cityEl=document.getElementById('ccCity');
  function goTo(i){steps.forEach((s,idx)=>s&&s.classList.toggle('active',idx===i));}

  const toStep2=document.getElementById('toStep2');
  if(toStep2)toStep2.addEventListener('click',()=>{
    if(!nameEl?.value.trim()||!phoneEl?.value.trim()||!cityEl?.value.trim()){alert('Please enter your name, phone and city to proceed.');return;}
    goTo(1);
  });
  const backTo1=document.getElementById('backTo1');
  if(backTo1)backTo1.addEventListener('click',()=>goTo(0));

  const scaleGrid=document.getElementById('scaleGrid');
  const toStep3Btn=document.getElementById('toStep3');
  if(scaleGrid){
    scaleGrid.addEventListener('click',(e)=>{
      const card=e.target.closest('.scale-card');
      if(!card)return;
      scaleGrid.querySelectorAll('.scale-card').forEach(c=>c.classList.remove('active'));
      card.classList.add('active');
      selectedStage=parseInt(card.dataset.stage,10);
      if(toStep3Btn)toStep3Btn.disabled=false;
    });
  }
  if(toStep3Btn)toStep3Btn.addEventListener('click',()=>goTo(2));
  const backTo2=document.getElementById('backTo2');
  if(backTo2)backTo2.addEventListener('click',()=>goTo(1));

  const pickFiles=document.getElementById('pickFiles');
  const fileInput=document.getElementById('ccFiles');
  const preview=document.getElementById('previewGrid');
  if(pickFiles&&fileInput&&preview){
    pickFiles.addEventListener('click',()=>fileInput.click());
    fileInput.addEventListener('change',()=>{
      preview.innerHTML='';
      [...fileInput.files].slice(0,4).forEach(f=>{
        const img=document.createElement('img');
        img.src=URL.createObjectURL(f);
        img.alt=f.name;
        preview.appendChild(img);
      });
    });
  }

  const toStep4=document.getElementById('toStep4');
  if(toStep4)toStep4.addEventListener('click',()=>{
    const grafts=estimateGrafts(selectedStage||2);
    document.getElementById('thanksName').textContent=nameEl?.value.trim()||'there';
    document.getElementById('nwStage').textContent=selectedStage||2;
    document.getElementById('graftCount').textContent=grafts.toLocaleString();
    goTo(3);
  });

  const openModal=()=>{modal.classList.add('show');document.body.style.overflow='hidden';goTo(0);};
  const closeModal=()=>{modal.classList.remove('show');document.body.style.overflow='';};
  if(openBtn)openBtn.addEventListener('click',openModal);
  if(closeBtn)closeBtn.addEventListener('click',closeModal);
  if(closeDone)closeDone.addEventListener('click',closeModal);
  modal.addEventListener('click',e=>{if(e.target===modal)closeModal();});
  document.addEventListener('keydown',e=>{if(e.key==='Escape'&&modal.classList.contains('show'))closeModal();});

  function estimateGrafts(stage){
    const t={1:[0,800],2:[800,1500],3:[1500,2500],4:[2500,3500],5:[3000,4500],6:[4000,5500],7:[5000,6500]};
    const [min,max]=t[stage]||[1500,3000];
    return Math.round((min+max)/2);
  }

  /* ===== Sticky Cost Calculator FAB (center-right, appears after #results) ===== */
  // Use the existing button in your HTML
  const fab = document.getElementById('calcFab');
  if (fab) fab.addEventListener('click', openModal);

//if (calcFab) calcFab.addEventListener('click', openModal);
if (getFreeAssementBtn) getFreeAssementBtn.addEventListener('click', openModal);
if (getFreeAssementBtn1) getFreeAssementBtn1.addEventListener('click', openModal);
if (getFreeAssementBtn2) getFreeAssementBtn2.addEventListener('click', openModal);
if (getFreeAssementBtn3) getFreeAssementBtn3.addEventListener('click', openModal);

  const target = document.getElementById('results');

  // Preferred: IntersectionObserver – reveals once and stays
  if (fab && target && 'IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries, obs)=>{
      entries.forEach(e=>{
        if (e.isIntersecting) {
          fab.classList.add('show');
          obs.disconnect(); // keep visible afterwards
        }
      });
    }, { threshold: 0.15 });
    io.observe(target);
  } else if (fab) {
    // Fallback: scroll listener + initial check
    function showFab(){
      // If there's no target, just reveal after a small scroll
      if (!target) {
        if ((window.scrollY || document.documentElement.scrollTop) > 300) {
          fab.classList.add('show');
          window.removeEventListener('scroll', showFab);
        }
        return;
      }
      const rect = target.getBoundingClientRect();
      const reached = rect.top <= window.innerHeight * 0.85;
      if (reached) {
        fab.classList.add('show');
        window.removeEventListener('scroll', showFab);
      }
    }
    window.addEventListener('scroll', showFab, { passive:true });
    showFab(); // run once on load so it appears even if user is already below
  }
})();