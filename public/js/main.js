document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('ipkIpsChart')?.getContext('2d');
    if(ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6','Semester 7', 'Semester 8'],
                datasets: [{
                        label: 'IPK',
                        data: [2.9, 3.0, 3.1, 3.2, 3.2, 3.1, 3.2, 0],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.2)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3
                    },
                    {
                        label: 'IPS',
                        data: [2.9, 3.4, 2.8, 3.4, 3.3, 2.8, 2.9, 0],
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99, 102, 241, 0.2)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: {
                    y: { beginAtZero: true, max: 4, ticks: { stepSize: 0.5 } },
                    x: { grid: { display: false } }
                }
            }
        });
    }
    const toastContainer = document.getElementById('toastContainer');
    function showToast(message, color) {
        if(!toastContainer || !message) return;
        const toast = document.createElement('div');
        toast.className = `px-4 py-3 text-white rounded shadow-lg flex items-center space-x-2`;
        toast.style.backgroundColor = color === "green" ? "#10b981" : "#ef4444";
        toast.innerHTML = `<i class="fas fa-check-circle"></i><span>${message}</span>`;
        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.style.transition = "opacity 0.5s, transform 0.5s";
            toast.style.opacity = 0;
            toast.style.transform = "translateX(100%)";
            setTimeout(() => toast.remove(), 500);
        }, 5000);
    }
    if(window.sessionData?.success) showToast(window.sessionData.success, "green");
    if(window.sessionData?.error) showToast(window.sessionData.error, "red");
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    if(togglePassword){
        togglePassword.addEventListener('click', function(){
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if(eyeIcon){
                if(type === 'text'){
                    eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L6.59 6.59m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>`;
                } else {
                    eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>`;
                }
            }
        });
    }
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const profileDropdownBtn = document.getElementById('profileDropdownBtn');
    const profileDropdown = document.getElementById('profileDropdown');
    const openLogoutModal = () => {
        logoutModal.classList.remove('hidden');
        profileDropdown.classList.add('hidden');
    };

    mobileMenuBtn?.addEventListener('click', ()=>{ sidebar?.classList.toggle('active'); overlay?.classList.toggle('active'); });
    overlay?.addEventListener('click', ()=>{ sidebar?.classList.remove('active'); overlay?.classList.remove('active'); });
    profileDropdownBtn?.addEventListener('click', ()=>{ profileDropdown?.classList.toggle('hidden'); });
    document.addEventListener('click', (e)=>{
        if(!profileDropdownBtn?.contains(e.target) && !profileDropdown?.contains(e.target)){
            profileDropdown?.classList.add('hidden');
        }
    });
    logoutBtn?.addEventListener('click', openLogoutModal);
    logoutHeaderBtn?.addEventListener('click', openLogoutModal);
    cancelLogout?.addEventListener('click', ()=>{ logoutModal?.classList.add('hidden'); });

});
