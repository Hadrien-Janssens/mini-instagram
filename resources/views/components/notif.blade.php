<div x-data="notificationComponent()" x-init="init()">
    <div x-show="notifications > 0"
        {{ $attributes->merge(['class' => 'absolute rounded-full bg-red-500 text-white w-4 h-4 flex justify-center items-center']) }}>
        <p class="text-xs font-extrabold"><span x-text="notifications"></span></p>
    </div>

    <script>
        function notificationComponent() {
            return {
                notifications: 0,

                // Méthode d'initialisation
                init() {
                    this.fetchNotifications();
                    setInterval(() => this.fetchNotifications(), 5000);
                },

                // Méthode de récupération des notifications
                fetchNotifications() {
                    axios.get('/notifications/unread-count')
                        .then(response => {
                            this.notifications = response.data.countNotificationsNotSeen;
                        })
                        .catch(error => {
                            console.error('Erreur lors de la récupération des notifications : ', error);
                        });
                }
            };
        }
    </script>
</div>
