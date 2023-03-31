<div x-data="main()">
    <div @click="changeTheme()" class="flex items-center h-full pointer">
        <div class="relative">
            <div
                class="block border-[1px] dark:border-white border-black dark:bg-gray-400 bg-gray-600 w-14 h-8 rounded-full">
                <div id="circle"
                    class="absolute left-1 top-1 dark:bg-gray-800 bg-gray-200 w-6 h-6 rounded-full transition-transform dark:translate-x-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path class="dark:block hidden" fill="rgb(209 213 219)"
                            stroke="rgb(209 213 219)" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                        <path class="dark:hidden block" fill="rgb(17 24 39)"
                            stroke="rgb(17 24 39)" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function main() {
        return {
            changeTheme() {
                if (document.documentElement.classList.contains('dark')) {
                    this.lightMode();
                } else {
                    this.darkMode();
                }
            },

            darkMode() {
                localStorage.theme = 'dark';
                document.documentElement.classList.add('dark');
            },

            lightMode() {
                localStorage.theme = 'light'
                document.documentElement.classList.remove('dark')
            },
        };
    }
</script>
