    <section class="pt-5">
        <div class="container about-container">
            <h3 class="title mb-5" data-entrance="from-top">
                {{ __('home.vision') }}
            </h3>
            @php
                $visions = \App\Models\Vision::query()->orderBy('sort_order')->get();
                $locale = app()->getLocale() === 'ar' ? 'ar' : 'en';
                $v1 = $visions->get(0);
                $v2 = $visions->get(1);
                $message = $visions->get(2);
                $messageItems = $visions->slice(3);
            @endphp
            <div class="row">
                <div class="col-xl-6 mb-4" data-entrance="from-top">
                    <div class="d-xl-flex gap-4 about-section">
                        <div style="min-width: max-content;" class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="88" viewBox="0 0 100 88" fill="none">
                                <g clip-path="url(#clip0_190_233)">
                                    <path d="M22.7199 43.89C22.7199 30.99 31.8099 20.18 43.9199 17.53C34.4499 18.74 24.5399 22.84 14.9399 29.59C6.28994 35.68 0.949941 41.71 0.729941 41.96C-0.240059 43.06 -0.240059 44.71 0.729941 45.81C0.949941 46.06 6.29994 52.09 14.9499 58.18C24.4699 64.87 34.2899 68.97 43.6999 70.21C31.7099 67.47 22.7299 56.71 22.7299 43.9L22.7199 43.89Z" fill="url(#paint0_linear_190_233)" />
                                    <path d="M28.54 43.89C28.54 55.56 38.03 65.05 49.7 65.05C61.37 65.05 70.86 55.56 70.86 43.89C70.86 32.22 61.37 22.73 49.7 22.73C38.03 22.73 28.54 32.22 28.54 43.89ZM53.59 35.15H61.36C62.97 35.15 64.27 36.45 64.27 38.06V45.83C64.27 47.44 62.97 48.74 61.36 48.74C59.75 48.74 58.45 47.44 58.45 45.83V45.09L51.77 51.77C50.63 52.91 48.79 52.91 47.65 51.77L43.88 48L40.16 51.72C39.02 52.86 37.18 52.86 36.04 51.72C34.9 50.58 34.9 48.74 36.04 47.6L41.82 41.82C42.96 40.68 44.8 40.68 45.94 41.82L49.71 45.59L54.33 40.97H53.59C51.98 40.97 50.68 39.67 50.68 38.06C50.68 36.45 51.98 35.15 53.59 35.15Z" fill="url(#paint1_linear_190_233)" />
                                    <path d="M98.69 41.96C98.47 41.71 93.12 35.68 84.47 29.59C74.87 22.84 64.97 18.73 55.49 17.53C67.6 20.19 76.69 31 76.69 43.89C76.69 56.78 67.71 67.46 55.72 70.2C65.12 68.96 74.95 64.86 84.47 58.17C93.12 52.09 98.46 46.06 98.69 45.8C99.66 44.7 99.66 43.05 98.69 41.95V41.96Z" fill="url(#paint2_linear_190_233)" />
                                    <path d="M72.62 71.91C71.82 70.52 70.03 70.04 68.64 70.84C67.25 71.64 66.77 73.43 67.57 74.82L70.58 80.03C71.39 81.43 73.17 81.9 74.56 81.1C75.95 80.3 76.43 78.51 75.63 77.12L72.62 71.91Z" fill="url(#paint3_linear_190_233)" />
                                    <path d="M49.71 11.65C51.32 11.65 52.62 10.35 52.62 8.74V2.91C52.62 1.3 51.32 0 49.71 0C48.1 0 46.8 1.3 46.8 2.91V8.74C46.8 10.35 48.1 11.65 49.71 11.65Z" fill="url(#paint4_linear_190_233)" />
                                    <path d="M68.7399 16.75C70.13 17.55 71.91 17.08 72.72 15.68L75.6299 10.64C76.4299 9.25 75.9599 7.47 74.5599 6.66C73.1699 5.86 71.39 6.33 70.58 7.73L67.67 12.77C66.87 14.16 67.3399 15.94 68.7399 16.75Z" fill="url(#paint5_linear_190_233)" />
                                    <path d="M49.71 75.92C48.1 75.92 46.8 77.22 46.8 78.83V84.85C46.8 86.46 48.1 87.76 49.71 87.76C51.32 87.76 52.62 86.46 52.62 84.85V78.83C52.62 77.22 51.32 75.92 49.71 75.92Z" fill="url(#paint6_linear_190_233)" />
                                    <path d="M26.7 15.68C27.51 17.08 29.29 17.55 30.68 16.75C32.07 15.95 32.55 14.16 31.75 12.77L28.84 7.73002C28.04 6.34002 26.25 5.86002 24.86 6.66002C23.47 7.46002 22.99 9.25002 23.79 10.64L26.7 15.68Z" fill="url(#paint7_linear_190_233)" />
                                    <path d="M30.7799 70.85C29.3899 70.05 27.6099 70.52 26.7999 71.92L23.7899 77.13C22.9899 78.52 23.4599 80.3 24.8599 81.11C26.2499 81.91 28.0299 81.44 28.8399 80.04L31.8499 74.83C32.6499 73.44 32.1799 71.66 30.7799 70.85Z" fill="url(#paint8_linear_190_233)" />
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_190_233" x1="47.5499" y1="94.58" x2="15.2899" y2="14.41" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint1_linear_190_233" x1="29.57" y1="53.38" x2="66.74" y2="35.87" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" stop-opacity="0" />
                                        <stop offset="1" stop-color="#62CCF4" />
                                    </linearGradient>
                                    <linearGradient id="paint2_linear_190_233" x1="86.48" y1="78.91" x2="54.22" y2="-1.25997" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint3_linear_190_233" x1="74.69" y1="83.66" x2="42.43" y2="3.48002" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint4_linear_190_233" x1="78.78" y1="4.4" x2="16.4201" y2="7.46" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint5_linear_190_233" x1="79.1199" y1="11.34" x2="16.76" y2="14.4" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint6_linear_190_233" x1="53.82" y1="92.0601" x2="21.56" y2="11.88" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint7_linear_190_233" x1="79.02" y1="9.18002" x2="16.65" y2="12.25" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint8_linear_190_233" x1="37.0099" y1="98.82" x2="4.74993" y2="18.65" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <clipPath id="clip0_190_233">
                                        <rect width="99.42" height="87.77" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                            <h5 class="mt-3 bold">{{ $v1?->{"head_title_{$locale}"} ?? __('home.vision') }}</h5>
                        </div>
                        <p>{!! $v1?->{"body_{$locale}"} !!}</p>
                    </div>
                </div>

                <div class="col-xl-6 mb-4" data-entrance="from-top">
                    <div class="d-xl-flex gap-4 about-section">
                        <div style="min-width: max-content;" class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="87" height="87" viewBox="0 0 87 87" fill="none">
                                <g clip-path="url(#clip0_190_272)">
                                    <path d="M2.7048 57.8713C2.01476 57.8713 1.32473 57.6091 0.786496 57.0709C-0.276163 56.0084 -0.276163 54.2974 0.786496 53.2349L9.39817 44.6246C10.4608 43.5621 12.1721 43.5621 13.2348 44.6246C14.2974 45.6871 14.2974 47.3981 13.2348 48.4606L4.62311 57.0709C4.09868 57.5953 3.40864 57.8713 2.7048 57.8713Z" fill="url(#paint0_linear_190_272)" />
                                    <path d="M9.68796 80.018C8.99792 80.018 8.30788 79.7558 7.76965 79.2177C6.70699 78.1552 6.70699 76.4441 7.76965 75.3817L23.9855 59.1683C25.0482 58.1058 26.7595 58.1058 27.8222 59.1683C28.8848 60.2308 28.8848 61.9418 27.8222 63.0043L11.6063 79.2177C11.0818 79.742 10.378 80.0042 9.68796 80.0042V80.018Z" fill="url(#paint1_linear_190_272)" />
                                    <path d="M31.852 87C31.162 87 30.4719 86.7379 29.9337 86.1997C28.8711 85.1372 28.8711 83.4262 29.9337 82.3637L38.5454 73.7534C39.608 72.6909 41.3193 72.6909 42.382 73.7534C43.4447 74.8159 43.4447 76.5269 42.382 77.5894L33.7703 86.1997C33.2459 86.7241 32.5559 87 31.852 87Z" fill="url(#paint2_linear_190_272)" />
                                    <path d="M79.3958 0.248399L8.63928 21.3602C3.29839 22.9471 2.92577 30.3707 8.07345 32.4957L38.4627 45.011C38.6007 44.6936 38.7939 44.39 39.0562 44.1279L54.5958 28.5907C55.6585 27.5282 57.3698 27.5282 58.4324 28.5907C59.4951 29.6532 59.4951 31.3642 58.4324 32.4267L42.8928 47.9639C42.6306 48.226 42.3269 48.4192 42.0095 48.5572L54.5406 78.9555C56.6659 84.1023 64.0769 83.7298 65.664 78.3897L86.7516 7.60304C88.0903 3.1047 83.9086 -1.09006 79.3958 0.248399Z" fill="url(#paint3_linear_190_272)" />
                                </g>
                                <defs>
                                    <linearGradient id="paint0_linear_190_272" x1="-0.000147476" y1="50.8478" x2="14.0352" y2="50.8478" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint1_linear_190_272" x1="6.96921" y1="69.2137" x2="28.6088" y2="69.2137" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint2_linear_190_272" x1="29.1333" y1="79.9766" x2="43.1686" y2="79.9766" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="paint3_linear_190_272" x1="4.40245" y1="41.2992" x2="87" y2="41.2992" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#62CCF4" />
                                        <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                    </linearGradient>
                                    <clipPath id="clip0_190_272">
                                        <rect width="87" height="87" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                            <h5 class="mt-3 bold">{{ $v2?->{"head_title_{$locale}"} ?? ' ' }}</h5>
                        </div>
                        <p>{!! $v2?->{"body_{$locale}"} !!}</p>
                    </div>
                </div>

                @if($visions->count() > 2)
                    <div class="col-xl-12 mb-4" data-entrance="from-top">
                        <div class="d-xl-flex gap-4 about-section">
                            <div style="min-width: max-content;" class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="89" height="89" viewBox="0 0 89 89" fill="none">
                                    <g clip-path="url(#clip0_190_247)">
                                        <path d="M29.3945 14.2176C29.4269 14.1206 29.4377 14.0343 29.4701 13.9373H19.2091C16.6736 13.9373 14.2891 15.1235 12.7462 17.1294L2.13999 31.052C1.36313 32.0657 0.845234 33.252 0.618652 34.5137H23.6545L29.3945 14.2284V14.2176Z" fill="url(#paint0_linear_190_247)" />
                                        <path d="M23.6653 37.652H0.661865C0.920816 38.903 1.47109 40.0677 2.28031 41.0598L37.8213 85.0598L37.6486 84.4775L23.6545 37.652H23.6653Z" fill="url(#paint1_linear_190_247)" />
                                        <path d="M51.3406 84.4559C49.7977 87.3784 87.0326 40.3481 86.7089 41.0598C87.5182 40.0677 88.0684 38.903 88.3489 37.652H65.3347L51.3406 84.4667V84.4559Z" fill="url(#paint2_linear_190_247)" />
                                        <path d="M76.2538 17.1294C74.7109 15.1235 72.3264 13.948 69.7908 13.9373H59.5083C59.5515 14.0343 59.5838 14.1314 59.6162 14.2392L65.3347 34.5137H88.3705C88.1439 33.252 87.626 32.0765 86.8492 31.052L76.2538 17.1294Z" fill="url(#paint3_linear_190_247)" />
                                        <path d="M26.9561 37.652L40.6804 83.5716L41.7918 87.2814C42.137 88.4677 43.4641 88.4892 44.4999 88.5108C45.525 88.4892 46.8521 88.4784 47.2081 87.2814L48.3195 83.5716L62.0438 37.652H26.9561Z" fill="url(#paint4_linear_190_247)" />
                                        <path d="M62.0547 34.5029C61.731 33.3382 56.757 15.7059 56.5844 15.0804C56.401 14.401 55.7752 13.9372 55.0739 13.9372H33.9154C32.3294 13.8725 32.2107 15.997 31.8438 17.0755L26.9346 34.5029H62.0547Z" fill="url(#paint5_linear_190_247)" />
                                        <path d="M21.2268 75.9578C17.0836 75.1274 13.8467 71.8921 13.0159 67.7509C12.8433 66.899 12.0125 66.349 11.1601 66.5215C10.5451 66.6509 10.0595 67.1254 9.93006 67.7509C9.09926 71.8921 5.86238 75.1274 1.71917 75.9578C0.866794 76.1519 0.327313 76.9931 0.521526 77.8451C0.651002 78.4382 1.12574 78.9127 1.71917 79.0421C5.86238 79.8725 9.09926 83.1078 9.93006 87.249C10.1027 88.1009 10.9335 88.6509 11.7859 88.4784C12.4009 88.349 12.8864 87.8745 13.0159 87.249C13.8467 83.1078 17.0836 79.8725 21.2268 79.0421C22.0792 78.848 22.6186 78.0068 22.4244 77.1549C22.2949 76.5617 21.8202 76.0872 21.2268 75.9578Z" fill="url(#paint6_linear_190_247)" />
                                        <path d="M74.0527 9.8931C76.6098 10.4 78.6059 12.3951 79.113 14.9509C79.2856 15.8029 80.1164 16.3529 80.9688 16.1804C81.5838 16.0509 82.0693 15.5764 82.1988 14.9509C82.7059 12.3951 84.702 10.4 87.2591 9.8931C88.1115 9.69898 88.651 8.8578 88.4568 8.00584C88.3273 7.4127 87.8526 6.9382 87.2591 6.80878C84.702 6.30192 82.7059 4.30682 82.1988 1.75094C82.0262 0.898979 81.1954 0.34898 80.343 0.521529C79.728 0.65094 79.2425 1.12545 79.113 1.75094C78.6059 4.30682 76.6098 6.30192 74.0527 6.80878C73.2003 7.0029 72.6608 7.84408 72.855 8.69604C72.9845 9.28918 73.4592 9.76369 74.0527 9.8931Z" fill="url(#paint7_linear_190_247)" />
                                    </g>
                                    <defs>
                                        <linearGradient id="paint0_linear_190_247" x1="0.618652" y1="24.2147" x2="29.4701" y2="24.2147" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#62CCF4" />
                                            <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_190_247" x1="0.661865" y1="61.3559" x2="37.832" y2="61.3559" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#62CCF4" />
                                            <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                        </linearGradient>
                                        <linearGradient id="paint2_linear_190_247" x1="89.6761" y1="61.1186" x2="57.0375" y2="61.1186" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#62CCF4" />
                                            <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                        </linearGradient>
                                        <linearGradient id="paint3_linear_190_247" x1="89.676" y1="24.2147" x2="57.0375" y2="24.2147" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#62CCF4" />
                                            <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                        </linearGradient>
                                        <linearGradient id="paint4_linear_190_247" x1="44.4999" y1="12.5245" x2="44.4999" y2="86.0196" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#62CCF4" />
                                            <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                        </linearGradient>
                                        <linearGradient id="paint5_linear_190_247" x1="44.5" y1="12.5245" x2="44.5" y2="86.0196" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#62CCF4" />
                                            <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                        </linearGradient>
                                        <linearGradient id="paint6_linear_190_247" x1="0.499947" y1="77.5" x2="22.4676" y2="77.5" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#62CCF4" />
                                            <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                        </linearGradient>
                                        <linearGradient id="paint7_linear_190_247" x1="72.8119" y1="8.36172" x2="88.4999" y2="8.36172" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#62CCF4" />
                                            <stop offset="1" stop-color="#62CCF4" stop-opacity="0" />
                                        </linearGradient>
                                        <clipPath id="clip0_190_247">
                                            <rect width="88" height="88" fill="white" transform="translate(0.5 0.5)" />
                                        </clipPath>
                                    </defs>
                                </svg>

                                <h5 class="mt-3 bold">{{ $message?->{"head_title_{$locale}"} }}</h5>
                            </div>

                            <div class="row">
                                @forelse($messageItems as $item)
                                    <div class="col-xl-6 mt-3">
                                        <h5 class="subtitle">{{ $item?->{"title_{$locale}"} ?? $item?->{"head_title_{$locale}"} }}</h5>
                                        <p>{!! $item?->{"body_{$locale}"} !!}</p>
                                    </div>
                                @empty
                                    @if($message)
                                        <div class="col-12 mt-3">
                                            <p>{!! $message?->{"body_{$locale}"} !!}</p>
                                        </div>
                                    @else
                                        <div class="col-12">
                                            <p class="text-center">{{ __('home.no_data') }}</p>
                                        </div>
                                    @endif
                                @endforelse
                            </div>

                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>
