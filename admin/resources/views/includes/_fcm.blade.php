
@if(Route::currentRouteName() == "supplier.login" || Route::currentRouteName() == "admin.login")
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js"></script>
    <script>

        const config = {
            apiKey: "AIzaSyA2EsJBk8YWmrr8YGD9Y-_IAcL7YMAYEpo",
            authDomain: "tradingPartner-29c51.firebaseapp.com",
            databaseURL: "https://tradingPartner-29c51.firebaseio.com",
            projectId: "tradingPartner-29c51",
            storageBucket: "tradingPartner-29c51.appspot.com",
            messagingSenderId: "1002783897845",
            appId: "1:1002783897845:web:3929468f7f6886c7326dbc",
            measurementId: "G-52NTN5RJ2X"
        };
        firebase.initializeApp(config);
        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                $('#web_token').val(token);
                console.log(token);
            })
            .catch(function (err) {
                console.log("Unable to get permission to notify.", err);
            });


    </script>
@else
    <script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-analytics.js"></script>
    <script>
        var config = {
            apiKey: "AIzaSyA2EsJBk8YWmrr8YGD9Y-_IAcL7YMAYEpo",
            authDomain: "tradingPartner-29c51.firebaseapp.com",
            databaseURL: "https://tradingPartner-29c51.firebaseio.com",
            projectId: "tradingPartner-29c51",
            storageBucket: "tradingPartner-29c51.appspot.com",
            messagingSenderId: "1002783897845",
            appId: "1:1002783897845:web:3929468f7f6886c7326dbc",
            measurementId: "G-52NTN5RJ2X"
        };
        firebase.initializeApp(config);
        messaging = firebase.messaging();
        messaging.onMessage(function(payload)
        {

            notificationTitle = payload.data.title;
            notificationOptions = {
                body: payload.data.body,
                icon: payload.data.icon,
                click_action: payload.data.url
            };
            var notification = new Notification(notificationTitle , notificationOptions);
            const {title, ...options} = payload.data;
        });

    </script>
@endif