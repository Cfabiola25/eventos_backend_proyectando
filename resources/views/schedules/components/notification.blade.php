<div id="notification" class="hidden fixed top-20 right-4 z-50 bg-white border-l-4 border-green-500 rounded-lg shadow-xl p-4 max-w-md transform transition-all duration-300">
    <div class="flex items-center">
        <div class="flex-shrink-0">
            <i id="notificationIcon" class="fas fa-check-circle text-green-500 text-2xl"></i>
        </div>
        <div class="ml-3">
            <p id="notificationMessage" class="text-sm font-medium text-gray-900"></p>
        </div>
        <button onclick="closeNotification()" class="ml-auto -mx-1.5 -my-1.5 text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex h-8 w-8">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>