<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Authorization</title>
    @vite('resources/css/app.css')
    <script>
        // Theme evaluation script - similar to theme.ts
        (function() {
            // Get theme setting from localStorage, default to 'system'
            const themeSetting = localStorage.getItem('theme') || 'system';

            // Get user's preferred color scheme
            const preferredColorScheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

            // Determine current theme
            let currentTheme;
            if (themeSetting === 'system') {
                // If user has no preference, default to dark (matching theme.ts logic)
                currentTheme = preferredColorScheme === 'no-preference' ? 'dark' : preferredColorScheme;
            } else {
                currentTheme = themeSetting;
            }

            // Apply theme class to html element
            document.documentElement.classList.remove('light', 'dark');
            document.documentElement.classList.add(currentTheme);

            // Listen for changes in color scheme preference
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                if (localStorage.getItem('theme') === 'system') {
                    const newTheme = e.matches ? 'dark' : 'light';
                    document.documentElement.classList.remove('light', 'dark');
                    document.documentElement.classList.add(newTheme);
                }
            });

            // Listen for localStorage changes (in case theme is changed in another tab)
            window.addEventListener('storage', function(e) {
                if (e.key === 'theme') {
                    const newThemeSetting = e.newValue || 'system';
                    let newTheme;

                    if (newThemeSetting === 'system') {
                        const preferredColorScheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                        newTheme = preferredColorScheme === 'no-preference' ? 'dark' : preferredColorScheme;
                    } else {
                        newTheme = newThemeSetting;
                    }

                    document.documentElement.classList.remove('light', 'dark');
                    document.documentElement.classList.add(newTheme);
                }
            });
        })();
    </script>
</head>
<body class="passport-authorize">
<div
    class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-default-background">
    <div>
        <svg
            class="h-12 py-2 fill-text-primary"
            viewBox="0 0 168 30"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M54.4081 6.78783C55.0812 7.46093 55.9225 7.79748 56.9322 7.79748C57.9936 7.79748 58.8479 7.46093 59.4951 6.78783C60.1682 6.08885 60.5048 5.22159 60.5048 4.18606C60.5048 3.17642 60.1682 2.3221 59.4951 1.62312C58.8479 0.924138 57.9936 0.574646 56.9322 0.574646C55.9225 0.574646 55.0812 0.924138 54.4081 1.62312C53.735 2.3221 53.3984 3.17642 53.3984 4.18606C53.3984 5.22159 53.735 6.08885 54.4081 6.78783Z" />
            <path
                d="M158.028 29.4272C155.905 29.4272 154.028 29.0129 152.397 28.1845C150.766 27.3302 149.485 26.1523 148.553 24.6508C147.621 23.1492 147.155 21.4277 147.155 19.4861C147.155 17.5703 147.608 15.8746 148.514 14.399C149.42 12.8975 150.65 11.7196 152.203 10.8653C153.782 9.98505 155.556 9.54495 157.523 9.54495C159.439 9.54495 161.134 9.95916 162.61 10.7876C164.112 11.5901 165.277 12.7163 166.105 14.166C166.959 15.5899 167.386 17.2208 167.386 19.0589C167.386 19.4472 167.361 19.8485 167.309 20.2627C167.283 20.651 167.205 21.1041 167.076 21.6218L150.339 21.6995V17.3503L164.396 17.2338L161.367 19.1366C161.342 18.0751 161.186 17.2079 160.901 16.5348C160.617 15.8358 160.202 15.3051 159.659 14.9427C159.115 14.5802 158.429 14.399 157.601 14.399C156.746 14.399 156.009 14.6061 155.387 15.0203C154.766 15.4345 154.287 16.017 153.95 16.7678C153.614 17.5185 153.446 18.4246 153.446 19.4861C153.446 20.5734 153.627 21.5053 153.989 22.282C154.352 23.0327 154.869 23.6023 155.543 23.9906C156.216 24.3789 157.044 24.5731 158.028 24.5731C158.96 24.5731 159.775 24.4178 160.474 24.1071C161.199 23.7964 161.846 23.3175 162.416 22.6703L165.95 26.2041C165.018 27.2655 163.879 28.068 162.532 28.6117C161.212 29.1553 159.711 29.4272 158.028 29.4272Z" />
            <path
                d="M114.306 29V10.0109H121.063V29H114.306ZM126.228 29V18.0104C126.228 17.2079 125.982 16.5866 125.49 16.1465C124.998 15.6805 124.39 15.4475 123.665 15.4475C123.147 15.4475 122.694 15.551 122.306 15.7581C121.917 15.9652 121.607 16.263 121.374 16.6513C121.167 17.0137 121.063 17.4668 121.063 18.0104L118.422 16.9619C118.422 15.4345 118.759 14.1272 119.432 13.0399C120.105 11.9526 121.011 11.1112 122.15 10.5158C123.289 9.92034 124.584 9.62262 126.034 9.62262C127.328 9.62262 128.493 9.93328 129.528 10.5546C130.59 11.15 131.431 11.9914 132.053 13.0787C132.674 14.166 132.985 15.4475 132.985 16.9231V29H126.228ZM138.149 29V18.0104C138.149 17.2079 137.903 16.5866 137.411 16.1465C136.92 15.6805 136.311 15.4475 135.586 15.4475C135.094 15.4475 134.641 15.551 134.227 15.7581C133.839 15.9652 133.528 16.263 133.295 16.6513C133.088 17.0137 132.985 17.4668 132.985 18.0104L129.024 17.8163C129.075 16.1076 129.451 14.6449 130.15 13.4282C130.849 12.2114 131.807 11.2795 133.023 10.6323C134.266 9.95917 135.664 9.62262 137.217 9.62262C138.693 9.62262 140.013 9.93328 141.178 10.5546C142.343 11.1759 143.249 12.082 143.896 13.2729C144.57 14.4378 144.906 15.8358 144.906 17.4668V29H138.149Z" />
            <path d="M103.573 29V10.011H110.369V29H103.573Z" />
            <path
                d="M104.428 6.78783C105.101 7.46093 105.942 7.79748 106.952 7.79748C108.013 7.79748 108.867 7.46093 109.515 6.78783C110.188 6.08885 110.524 5.22159 110.524 4.18606C110.524 3.17642 110.188 2.3221 109.515 1.62312C108.867 0.924138 108.013 0.574646 106.952 0.574646C105.942 0.574646 105.101 0.924138 104.428 1.62312C103.755 2.3221 103.418 3.17642 103.418 4.18606C103.418 5.22159 103.755 6.08885 104.428 6.78783Z" />
            <path
                d="M90.2867 29V2.16681H97.0435V29H90.2867ZM86.0928 15.6417V10.011H101.237V15.6417H86.0928Z" />
            <path
                d="M72.4414 29.3883C70.6033 29.3883 68.9853 28.9612 67.5873 28.1068C66.1893 27.2525 65.0891 26.0876 64.2866 24.6119C63.5099 23.1104 63.1216 21.4147 63.1216 19.5249C63.1216 17.6091 63.5099 15.9005 64.2866 14.399C65.0891 12.8975 66.1764 11.7325 67.5485 10.9041C68.9464 10.0498 70.5774 9.62262 72.4414 9.62262C73.6322 9.62262 74.7454 9.84267 75.781 10.2828C76.8165 10.697 77.6837 11.2924 78.3827 12.0691C79.0817 12.8457 79.4959 13.7259 79.6254 14.7097V23.9906C79.4959 24.9744 79.0817 25.8805 78.3827 26.7089C77.6837 27.5373 76.8165 28.1975 75.781 28.6893C74.7454 29.1553 73.6322 29.3883 72.4414 29.3883ZM73.6452 23.3693C74.3959 23.3693 75.0431 23.214 75.5868 22.9033C76.1304 22.5668 76.5576 22.1137 76.8683 21.5442C77.2048 20.9487 77.3731 20.2627 77.3731 19.4861C77.3731 18.7353 77.2177 18.0751 76.9071 17.5056C76.5964 16.9361 76.1563 16.483 75.5868 16.1465C75.0431 15.8099 74.4089 15.6416 73.684 15.6416C72.9591 15.6416 72.3119 15.8099 71.7424 16.1465C71.1987 16.483 70.7586 16.949 70.4221 17.5444C70.1114 18.114 69.9561 18.7612 69.9561 19.4861C69.9561 20.2368 70.1114 20.9099 70.4221 21.5053C70.7327 22.0749 71.1728 22.5279 71.7424 22.8645C72.3119 23.201 72.9462 23.3693 73.6452 23.3693ZM83.7416 29H77.1012V23.9129L78.0721 19.2531L76.9848 14.6708V0.691162H83.7416V29Z" />
            <path d="M53.5537 29V10.011H60.3494V29H53.5537Z" />
            <path d="M42.8608 29V0.691162H49.6177V29H42.8608Z" />
            <path
                d="M29.6176 29.4272C27.5724 29.4272 25.7473 29 24.1423 28.1457C22.5631 27.2655 21.3075 26.0746 20.3755 24.5731C19.4435 23.0457 18.9775 21.3371 18.9775 19.4472C18.9775 17.5574 19.4306 15.8746 20.3367 14.399C21.2687 12.8975 22.5372 11.7196 24.1423 10.8653C25.7473 9.98505 27.5595 9.54495 29.5788 9.54495C31.5981 9.54495 33.3973 9.98505 34.9765 10.8653C36.5816 11.7196 37.8501 12.8975 38.7821 14.399C39.714 15.8746 40.18 17.5574 40.18 19.4472C40.18 21.3371 39.714 23.0457 38.7821 24.5731C37.876 26.0746 36.6204 27.2655 35.0153 28.1457C33.4361 29 31.6369 29.4272 29.6176 29.4272ZM29.5788 23.4081C30.3295 23.4081 30.9768 23.2528 31.5204 22.9421C32.09 22.6056 32.5301 22.1396 32.8407 21.5442C33.1514 20.9487 33.3067 20.2627 33.3067 19.4861C33.3067 18.7094 33.1384 18.0363 32.8019 17.4668C32.4912 16.8713 32.0641 16.4183 31.5204 16.1076C30.9768 15.7711 30.3295 15.6028 29.5788 15.6028C28.8539 15.6028 28.2067 15.7711 27.6372 16.1076C27.0676 16.4442 26.6275 16.9102 26.3169 17.5056C26.0062 18.0751 25.8509 18.7482 25.8509 19.5249C25.8509 20.2756 26.0062 20.9487 26.3169 21.5442C26.6275 22.1396 27.0676 22.6056 27.6372 22.9421C28.2067 23.2528 28.8539 23.4081 29.5788 23.4081Z" />
            <path
                d="M9.20323 29.5437C8.03825 29.5437 6.88622 29.3883 5.74714 29.0777C4.63394 28.767 3.58547 28.3528 2.60172 27.835C1.64385 27.2914 0.828369 26.6701 0.155273 25.9711L3.84435 22.2043C4.46567 22.8515 5.20349 23.3564 6.0578 23.7188C6.938 24.0812 7.86998 24.2624 8.85373 24.2624C9.42328 24.2624 9.85043 24.1848 10.1352 24.0295C10.4459 23.8741 10.6012 23.6541 10.6012 23.3693C10.6012 22.9551 10.3811 22.6444 9.94104 22.4373C9.52683 22.2043 8.97023 22.0102 8.27125 21.8548C7.59815 21.6736 6.88623 21.4665 6.13547 21.2335C5.38471 20.9746 4.65983 20.6381 3.96085 20.2239C3.26187 19.8097 2.69232 19.2272 2.25222 18.4764C1.83801 17.7257 1.63091 16.7678 1.63091 15.6028C1.63091 14.3861 1.95451 13.3247 2.60172 12.4186C3.27481 11.4866 4.20679 10.7617 5.39765 10.2439C6.58851 9.70029 7.98648 9.42847 9.59155 9.42847C11.2225 9.42847 12.7758 9.71324 14.2514 10.2828C15.7271 10.8264 16.9179 11.6549 17.824 12.7681L14.0961 16.5348C13.4748 15.8358 12.7888 15.3569 12.038 15.098C11.2872 14.8132 10.6012 14.6708 9.97987 14.6708C9.38444 14.6708 8.95729 14.7615 8.6984 14.9427C8.43952 15.098 8.31008 15.318 8.31008 15.6028C8.31008 15.9394 8.51719 16.2112 8.9314 16.4183C9.3715 16.6254 9.9281 16.8196 10.6012 17.0008C11.3002 17.1561 12.0121 17.3632 12.737 17.6221C13.4877 17.881 14.1997 18.2434 14.8728 18.7094C15.5717 19.1495 16.1283 19.7449 16.5426 20.4957C16.9827 21.2465 17.2027 22.2173 17.2027 23.4081C17.2027 25.298 16.4778 26.7995 15.0281 27.9127C13.5783 29 11.6367 29.5437 9.20323 29.5437Z" />
        </svg>
    </div>

    <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-card-background shadow-md border border-card-border overflow-hidden sm:rounded-lg">

        <!-- Introduction -->
        <p class="text-center pb-4 text-text-primary"><strong class="text-text-primary">{{ $client->name }}</strong> is requesting permission
            to access your
            account.</p>

        <!-- Scope List -->
        @if (count($scopes) > 0)
            <div class="pb-4">
                <p class="text-text-primary"><strong>This application will be able to:</strong></p>

                <ul class="list-disc pl-5 py-2 text-text-primary">
                    @foreach ($scopes as $scope)
                        <li>{{ $scope->description }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:space-x-5 space-x-0 space-y-3 sm:space-y-0">
            <!-- Authorize Button -->
            <form method="post" class="flex-1" action="{{ route('passport.authorizations.approve') }}">
                @csrf

                <input type="hidden" name="state" value="{{ $request->state }}">
                <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                <button type="submit"
                        class="w-full text-center items-center px-2 sm:px-3 py-2 bg-accent-300/10 border border-accent-300/20 rounded-md font-semibold text-xs sm:text-sm text-text-primary hover:bg-accent-300/20 active:bg-accent-300/20 focus:outline-none focus:ring-2 focus:ring-accent-300 focus:ring-offset-2 transition ease-in-out duration-150">
                    Authorize
                </button>
            </form>

            <!-- Cancel Button -->
            <form method="post" class="flex-1" action="{{ route('passport.authorizations.deny') }}">
                @csrf
                @method('DELETE')

                <input type="hidden" name="state" value="{{ $request->state }}">
                <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                <input type="hidden" name="auth_token" value="{{ $authToken }}">
                <button
                    class="w-full text-center text-xs sm:text-sm px-2 sm:px-3 py-2 bg-button-secondary-background border border-button-secondary-border hover:bg-button-secondary-background-hover shadow-sm transition text-text-primary rounded-lg font-medium items-center space-x-1.5 focus-visible:border-input-border-active focus:outline-none focus:ring-0 disabled:opacity-25 ease-in-out">
                    Cancel
                </button>
            </form>
        </div>

    </div>

</div>
</body>
</html>
