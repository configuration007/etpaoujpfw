@extends('layouts.index')
@section('css')
    <link href="{{ asset('assets/css/app2.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="cDOidB">
        <div class="cRVwGH">
            <div class="jqlzrh">
                <div class="aSYAaAs">
                    <h1 class="jlIOXB">Mining Market </h1>
                </div>
            </div>
        </div>
        <div class="jqlzrh">
            <div class="lextIZ">
                <div class="evZIbd">
                    <div class="iGlXs">
                            <table class="gSBYmX" id="aBaewsa">
                    
                            </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="kWOass">
            <div class="jqlzrh">
                <div class="iGlXs">
                    <table class="gSBYmX" id="aBaewsa">
                    
                    </table>
                </div>
            </div>
        </div> --}}
        <div class="kWmQrl">
            <div class="lrNYe">
                <div class="jqlzrh">
                    <h2 class="isRrJb">
                        A simple, powerful dashboard
                    </h2>
                    <div class="hwxLFE">
                        <img alt="Powerful Dashboard" width="1159" height="668"
                            src="/assets/images/landing_dashboard-img.png"
                            class="kWvxxP">
                    </div>
                </div>
                <div class="jqlzrh">
                    <div class="eXWFdx">
                        <div class="kbUODQ">
                            <div class="tFROF">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path
                                        d="M27.0008 7L19.2928 1V4H8.4715C7.64112 3.99985 6.8271 4.2309 6.12062 4.66726C5.41415 5.10363 4.84312 5.72808 4.4715 6.47067V6.47067C3.98445 7.44537 3.87012 8.5644 4.15002 9.61745C4.42992 10.6705 5.08477 11.5851 5.9915 12.1893L8.70884 14V12C8.70884 11.4696 8.91955 10.9609 9.29462 10.5858C9.66969 10.2107 10.1784 10 10.7088 10H19.2928V13L27.0008 7Z"
                                        stroke="CurrentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M4.70703 25L12.999 31V28H23.5324C24.3628 28.0005 25.177 27.7695 25.8835 27.3331C26.59 26.8967 27.161 26.2721 27.5324 25.5293V25.5293C28.0195 24.555 28.1339 23.4363 27.8543 22.3835C27.5746 21.3306 26.9201 20.4162 26.0137 19.812L23.291 18V20C23.291 20.5304 23.0803 21.0391 22.7052 21.4142C22.3302 21.7893 21.8215 22 21.291 22H12.999V19L4.70703 25Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                <h3 class="iqBHHF">Buy and sell in microseconds.</h3>
                                <P class="vvWMe">
                                    Over 40 trading pairs including BTC, ETH, DeFi, Stablecoins, and more.
                                </P>
                            </div>
                            <div class="tFROF">
                                <svg width="32" height="32" viewBox="0 0 34 33" fill="none">
                                    <path
                                        d="M7.85764 28H22.9751C23.515 28.0001 24.0375 27.8119 24.45 27.4689C24.8625 27.126 25.1384 26.6503 25.2287 26.1262L29.2469 2.87231C29.3376 2.3485 29.6136 1.87317 30.0261 1.53049C30.4386 1.18781 30.9609 0.999887 31.5006 1H33M26.0714 21.2489H7.67784C6.65855 21.2488 5.66854 20.9133 4.86513 20.2957C4.06171 19.6781 3.49099 18.8139 3.24364 17.8403L1.03416 9.13886C0.991999 8.97291 0.988822 8.79969 1.02487 8.63235C1.06092 8.46502 1.13524 8.30798 1.24219 8.17317C1.34915 8.03836 1.48591 7.92934 1.64208 7.85439C1.79825 7.77944 1.96973 7.74053 2.14347 7.74062H28.4043M25.0078 7.74662L20.4364 3.24587C20.0078 2.82399 19.4265 2.587 18.8205 2.587C18.2144 2.587 17.6331 2.82399 17.2045 3.24587L12.6332 7.74662M15.8742 4.54809L10.5105 2.99833C9.929 2.83059 9.3036 2.89708 8.77184 3.18319C8.24007 3.4693 7.84547 3.95161 7.67479 4.52409L6.71481 7.74662"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <circle cx="26" cy="31" r="2" fill="currentColor"></circle>
                                    <circle cx="6" cy="31" r="2" fill="currentColor"></circle>
                                </svg>
                                <h3 class="iqBHHF">Top crypto trading pairs.</h3>
                                <P class="vvWMe">
                                    Lightning-fast mines get you real market prices in real-time.
                                </P>
                            </div>
                            <div class="tFROF">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <circle cx="5.5" cy="10.5" r="1.5" fill="currentColor"></circle>
                                    <circle cx="16" cy="16" r="5" stroke="currentColor" stroke-width="2"></circle>
                                    <circle cx="26.5" cy="21.5" r="1.5" fill="currentColor"></circle>
                                    <rect x="1" y="6" width="30" height="20" rx="2" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></rect>
                                </svg>
                                <h3 class="iqBHHF">
                                    Save when you mine more.
                                </h3>
                                <P class="vvWMe">
                                    The more you mine the lower your fees, giving you an edge.
                                </P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gdsXZF">
                <div class="jqlzrh">
                    <div class="iBpQWi">
                        <div class="hFDlJy">
                            <img src="/assets/images/landing_low-fees-img.png" alt="" class="bLzVlC">
                        </div>
                        <div class="cWdcgC">
                            <div class="hTcMQH">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path
                                        d="M16 0C12.8355 0 9.74207 0.938384 7.11088 2.69649C4.4797 4.45459 2.42894 6.95345 1.21793 9.87706C0.00693258 12.8007 -0.309921 16.0177 0.307443 19.1214C0.924806 22.2251 2.44866 25.0761 4.6863 27.3137C6.92394 29.5513 9.77487 31.0752 12.8786 31.6926C15.9823 32.3099 19.1993 31.9931 22.1229 30.7821C25.0466 29.5711 27.5454 27.5203 29.3035 24.8891C31.0616 22.2579 32 19.1645 32 16C31.9954 11.7579 30.3082 7.69095 27.3087 4.69136C24.3091 1.69177 20.2421 0.00458811 16 0V0ZM11.8987 16.1253C12.1283 16.2328 12.3225 16.4036 12.4585 16.6175C12.5946 16.8315 12.6668 17.0798 12.6667 17.3333V19C12.6667 19.0884 12.7018 19.1732 12.7643 19.2357C12.8268 19.2982 12.9116 19.3333 13 19.3333H18C18.3536 19.3333 18.6928 19.4738 18.9428 19.7239C19.1929 19.9739 19.3333 20.313 19.3333 20.6667C19.3333 21.0203 19.1929 21.3594 18.9428 21.6095C18.6928 21.8595 18.3536 22 18 22H13C12.9116 22 12.8268 22.0351 12.7643 22.0976C12.7018 22.1601 12.6667 22.2449 12.6667 22.3333V24C12.6666 24.2534 12.5943 24.5014 12.4583 24.7152C12.3223 24.929 12.1282 25.0995 11.8988 25.207C11.6694 25.3144 11.4141 25.3543 11.1628 25.3219C10.9115 25.2895 10.6747 25.1861 10.48 25.024L6.48001 21.6907C6.32972 21.5655 6.2088 21.4089 6.12581 21.2318C6.04282 21.0547 5.99981 20.8616 5.99981 20.666C5.99981 20.4704 6.04282 20.2773 6.12581 20.1002C6.2088 19.9231 6.32972 19.7665 6.48001 19.6413L10.48 16.308C10.6747 16.1459 10.9115 16.0427 11.1628 16.0103C11.414 15.978 11.6693 16.0179 11.8987 16.1253ZM20.6667 16C20.3131 16 19.9739 15.8595 19.7239 15.6095C19.4738 15.3594 19.3333 15.0203 19.3333 14.6667V13C19.3333 12.9116 19.2982 12.8268 19.2357 12.7643C19.1732 12.7018 19.0884 12.6667 19 12.6667H14C13.6464 12.6667 13.3072 12.5262 13.0572 12.2761C12.8072 12.0261 12.6667 11.687 12.6667 11.3333C12.6667 10.9797 12.8072 10.6406 13.0572 10.3905C13.3072 10.1405 13.6464 10 14 10H19C19.0884 10 19.1732 9.96488 19.2357 9.90237C19.2982 9.83986 19.3333 9.75507 19.3333 9.66667V8C19.3332 7.74653 19.4053 7.49827 19.5412 7.28432C19.6771 7.07036 19.8711 6.89957 20.1006 6.79196C20.3301 6.68435 20.5855 6.64438 20.8369 6.67674C21.0883 6.7091 21.3253 6.81245 21.52 6.97467L25.52 10.308C25.6703 10.4331 25.7912 10.5898 25.8742 10.7669C25.9572 10.9439 26.0002 11.1371 26.0002 11.3327C26.0002 11.5282 25.9572 11.7214 25.8742 11.8985C25.7912 12.0755 25.6703 12.2322 25.52 12.3573L21.52 15.6907C21.2805 15.8904 20.9785 15.9999 20.6667 16Z"
                                        fill="currentColor"></path>
                                </svg>
                            </div>
                            <h2 class="figPwV">Mine at low cost</h2>
                            <p class="iOiGTn">
                                As you mining more per month, you’ll qualify for lower and lower fees. Unlock white glove
                                support when you mine over $100k in volume in a 30 day period.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/stat.js') }}" defer></script>
@endsection
