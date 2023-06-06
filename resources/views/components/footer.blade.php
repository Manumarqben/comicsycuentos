<footer
    class=" py-20 items-center overflow-hidden bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 z-50">
    <div class="relative m-auto px-3 md:px-6">
        <div class="m-auto md:w-10/12 lg:w-8/12 xl:w-6/12">
            <div
                class="flex flex-wrap items-center md:justify-between md:flex-nowrap">
                <div
                    class="w-full space-x-12 flex justify-center sm:w-7/12 sm:justify-around">
                    <ul class="list-disc list-inside space-y-8">
                        <li>
                            <a href="#"
                                class="hover:text-sky-400 transition">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="hover:text-sky-400 transition">
                                About
                            </a>
                        </li>
                        <li>
                            <a href="https://manumarqben.github.io/comicsycuentos/"
                                target="_blank"
                                class="hover:text-sky-400 transition">
                                Guide
                            </a>
                        </li>
                    </ul>

                    <ul role="list" class="space-y-8" x-data>
                        <li class="flex items-center space-x-3 hover:text-sky-400 transition cursor-pointer"
                            @click="window.open('https://github.com/Manumarqben/comicsycuentos', 'CyC', 'fullscreen=yes')">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" class="w-5"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                            </svg>
                            <span>Github</span>
                        </li>
                        <li class="flex items-center space-x-3 hover:text-sky-400 transition cursor-pointer"
                            @click="window.open('https://twitter.com/')">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" class="w-5"
                                viewBox="0 0 16 16">
                                <path
                                    d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                            </svg>
                            <span>Twitter</span>
                        </li>
                    </ul>
                </div>
                <div
                    class="w-10/12 m-auto mt-16 space-y-6 text-center md:text-end sm:w-5/12 sm:mt-auto">
                    <span class="block">
                        From children to experts, a space for all literary
                        voices!
                        {{-- Discover, share and immerse yourself in a world of literary creativity. --}}
                    </span>

                    <span class="block">
                        comicsycuentos &copy;2023
                    </span>
                </div>
            </div>
        </div>
    </div>
</footer>
