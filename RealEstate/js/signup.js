
// document.addEventListener('DOMContentLoaded', function () {
//     const step1 = document.querySelector('.step-1');
//     const step2Renter = document.querySelector('.step-2.renter');
//     const step2Agent = document.querySelector('.step-2.agent');
//     const nextBtn = document.querySelector('.next');
//     const prevBtnRenter = document.querySelector('#previousRenter');
//     const prevBtnAgent = document.querySelector('#previousAgent');
//     const userTypeDropdown = document.querySelector('#userType');
    
//     console.log(nextBtn)
        
//     function showStep1() {
//         step1.style.display = 'block';
//         step2Renter.style.display = 'none';
//         step2Agent.style.display = 'none';
//         // prevBtnRenter.style.display = 'none';
//         // prevBtnAgent.style.display = 'none';
//         nextBtn.style.display = 'inline-block';
//     }
    
//     function showStep2() {
//         step1.style.display = 'none';
//         if (userTypeDropdown.value === 'renter') {
//             step2Renter.style.display = 'block';
//             step2Agent.style.display = 'none';
//         } else if (userTypeDropdown.value === 'agent') {
//             step2Renter.style.display = 'none';
//             step2Agent.style.display = 'block';
//         }
//     }

//     prevBtnRenter.addEventListener('click', showStep1);
//     prevBtnAgent.addEventListener('click', showStep1);
//     nextBtn.addEventListener('click', showStep2);
// });