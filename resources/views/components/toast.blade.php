<!-- Komponen Toast -->
<div id="toast" class="hidden fixed top-4 right-4 bg-green-500 text-white p-4 rounded shadow-lg transition-all duration-300" role="alert">
    <div class="flex items-center">
        <div id="toast-message" class="text-sm"></div>
    </div>
</div>

<script>
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        toastMessage.textContent = message;

        // Update toast background color based on type
        if (type === 'success') {
            toast.classList.add('bg-green-500');
            toast.classList.remove('bg-red-500');
        } else if (type === 'error') {
            toast.classList.add('bg-red-500');
            toast.classList.remove('bg-green-500');
        }

        // Show the toast
        toast.classList.remove('hidden');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000); // Toast will be hidden after 3 seconds
    }
</script>

<style>
    /* Optional: Add additional styling here if needed */
</style>