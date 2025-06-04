// Auto-hide toast after 5 seconds
document.addEventListener("DOMContentLoaded", function () {
    const toast = document.getElementById("toast");
    if (toast) {
        setTimeout(() => {
            toast.style.opacity = "0";
            setTimeout(() => toast.remove(), 300); // Remove element after fade-out
        }, 5000); // 5 seconds
    }
});
