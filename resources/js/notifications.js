if ('Notification' in window) {
    Notification.requestPermission().then(function(permission) {
        if (permission === 'granted') {
            subscribeToNotifications();
        }
    });
}

function subscribeToNotifications() {
    Echo.private('notifications')
        .listen('EventNotification', (e) => {
            new Notification('Stembayo Events', {
                body: e.message,
                icon: '/path/to/icon.png'
            });
        });
} 