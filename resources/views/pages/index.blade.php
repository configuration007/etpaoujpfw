@extends('layouts.index')

@section('content')
    <div class="cDOidB">

        <div class="cePXDf  base-index">
            <div class="sEDWS">
                <img src="/assets/images/Blockchain-one.gif" alt="" class="">
            </div>
            <div class="jqlzrh">
                <div class="cmBafN">
                    <div class="ldGnJz">
                        <h1 class="cCjakL kRtqet">
                            The world’s most secure and effective mining Platform
                        </h1>
                        <p class="hrbjxU">
                            Trusted by millions since 2015 and backed by the most trusted technology and smart contracts
                        </p>
                        <div class="">
                            <a href="{{ url('register') }}" class="cnYUjy">Get Started</a>
                            <a href="{{ url('login') }}" class="dYRmHy">Login</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="jqlzrh">
            <div class="lextIZ">
                <div class="evZIbd">
                    <div class="iGlXs">
                        <div class="hIwTsa">
                            @include('partials._price', ['currency'=>'bitcoin','code'=>'btc'])
                            @include('partials._price', ['currency'=>'ethereum','code'=>'eth'])
                            @include('partials._price', ['currency'=>'ripple','code'=>'xlm'])
                            @include('partials._price', ['currency'=>'stellar','code'=>'algo'])
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="LQmm">
            <div class="jqlzrh">
                <div class="iXKGHe isDesktop">
                    <div class="chaLIY">
                        <div class="TDzzN DdADE">
                            <svg width="137" height="32" fill="none">
                                <path
                                    d="m2.66797 21.3333v-14.66663c0-1.47276 1.1939-2.66667 2.66666-2.66667h21.33337c1.4727 0 2.6666 1.19391 2.6666 2.66667v14.66663c0 1.4728-1.1939 2.6667-2.6666 2.6667h-21.33336c-1.47276 0-2.66667-1.1939-2.66667-2.6667z"
                                    fill="#fff"></path>
                                <path
                                    d="m2.66797 21.3333v-14.66663c0-1.47276 1.1939-2.66667 2.66666-2.66667h21.33337c1.4727 0 2.6666 1.19391 2.6666 2.66667v14.66663c0 1.4728-1.1939 2.6667-2.6666 2.6667h-21.33336c-1.47276 0-2.66667-1.1939-2.66667-2.6667z"
                                    fill="#5322e5" fill-opacity=".36"></path>
                                <path
                                    d="m2.66797 21.3333v-14.66663c0-1.47276 1.1939-2.66667 2.66666-2.66667h21.33337c1.4727 0 2.6666 1.19391 2.6666 2.66667v14.66663c0 1.4728-1.1939 2.6667-2.6666 2.6667h-21.33336c-1.47276 0-2.66667-1.1939-2.66667-2.6667z"
                                    stroke="#7349f2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                <path
                                    d="m2.66797 21.3335v-8h26.66663v8c0 1.4728-1.1939 2.6667-2.6666 2.6667h-21.33336c-1.47276 0-2.66667-1.1939-2.66667-2.6667z"
                                    fill="#fff" stroke="#7349f2" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"></path>
                                <path
                                    d="m2.66797 22.5585v-15.78365c0-1.36511 1.33739-2.32905 2.63245-1.89737l15.54418 5.18142c1.0889.3629 1.8234 1.382 1.8234 2.5298v14.3782c0 1.8201-1.7832 3.1054-3.51 2.5298l-15.12249-5.0409c-.81668-.2722-1.36754-1.0365-1.36754-1.8973z"
                                    fill="#fff"></path>
                                <path
                                    d="m2.66797 22.5585v-15.78365c0-1.36511 1.33739-2.32905 2.63245-1.89737l15.54418 5.18142c1.0889.3629 1.8234 1.382 1.8234 2.5298v14.3782c0 1.8201-1.7832 3.1054-3.51 2.5298l-15.12249-5.0409c-.81668-.2722-1.36754-1.0365-1.36754-1.8973z"
                                    fill="#5322e5" fill-opacity=".36"></path>
                                <g stroke="#7349f2" stroke-width="2">
                                    <path
                                        d="m2.66797 22.5585v-15.78365c0-1.36511 1.33739-2.32905 2.63245-1.89737l15.54418 5.18142c1.0889.3629 1.8234 1.382 1.8234 2.5298v14.3782c0 1.8201-1.7832 3.1054-3.51 2.5298l-15.12249-5.0409c-.81668-.2722-1.36754-1.0365-1.36754-1.8973z"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <circle cx="16.668" cy="19.3335" fill="#fff" r="2"></circle>
                                </g>
                            </svg>
                            <p class="gNGpcW">
                                Miner
                            </p>
                        </div>
                        <h2 class="iQLqHO">The Most Powerful Mining platform</h2>

                        <div class="eyLHGH">
                            @include('partials.unit-tab' ,[
                            'header' => 'Zero Inflation Impact',
                            'desc' =>'In developing countries such as Venezuela, life’s a struggle as inflation heads for
                            one million percent.',
                            'class' => 'eHbXX img_dfts active',
                            'text_class' => 'vvWMe hbnAur active'
                            ])
                            @include('partials.unit-tab' ,[
                            'header' => '2B Access',
                            'desc' =>'In the world without any access or ability to obtain a bank account or manage their
                            money.',
                            'class' => 'eHbXX img_dfts',
                            'text_class' => 'vvWMe hbnAur'
                            ])

                            @include('partials.unit-tab' ,[
                            'header' => 'Low Volatility Risk',
                            'desc' =>'Under Low Volatility Risk please change the write up to “One of the big problems is the volatility of crypto. Blockchain remote mining provides a minimal risk return proxy.',
                            'class' => 'eHbXX img_dfts',
                            'text_class' => 'vvWMe hbnAur'
                            ])
                            @include('partials.unit-tab' ,[
                            'header' => 'Minimal Complexity',
                            'desc' =>'Setting up a mining farm is extremely complex with countless smart contracts, this
                            comes out of the box, pre-installed.',
                            'class' => 'eHbXX img_dfts',
                            'text_class' => 'vvWMe hbnAur'
                            ])
                            @include('partials.unit-tab' ,[
                            'header' => 'Early Return on Investment (ROI)',
                            'desc' =>'With a pre-configured mining farm, return on investment is generated within the first month of deposit, and consecutively.',
                            'class' => 'eHbXX img_dfts',
                            'text_class' => 'vvWMe hbnAur'
                            ])

                            <a href="{{ url('register') }}" class="fQXoGc eaEhQt">
                                Get Started
                            </a>
                        </div>
                    </div>
                    <div class="dUizKc">
                        <div class="ccJpOt">
                            <img src="/assets/images/img-1.png" alt="" class="kQrdDU active" width="353" height="576">
                            <img src="/assets/images/img-2.png" alt="" class="kQrdDU" width="413" height="576">
                            <img src="/assets/images/img-3.png" alt="" class="kQrdDU" width="409" height="576">
                            <img src="/assets/images/img-4.png" alt="" class="kQrdDU iJybLU" width="1075" height="683">
                            <img src="/assets/images/img-5.png" alt="" class="kQrdDU iJybLU" width="1162" height="683">
                        </div>
                    </div>
                </div>

                <div class="iXKGHe isMobile">
                    <div class="slick-carousel  sliderHolder liTytT">
                        @include('partials.card-one' ,[
                        'head_text' => 'The Easiest and Most Powerful Crypto Wallet',
                        'mid_text' => 'Zero Inflation Impact',
                        'last_text' => 'In developing countries such as Venezuela, life’s a struggle as inflation heads for
                        one million percent.',
                        'image_url' => '/assets/images/img-1.png',
                        'image_width' => '230',
                        'image_height' => '375'
                        ])
                        @include('partials.card-one' ,[
                        'head_text' => 'The Easiest and Most Powerful Crypto Wallet',
                        'mid_text' => '2B Access',
                        'last_text' => 'In the world without any access or ability to obtain a bank account or manage their
                        money.',
                        'image_url' => '/assets/images/img-2.png',
                        'image_width' => '269',
                        'image_height' => '375'

                        ])
                        @include('partials.card-one' ,[
                        'head_text' => 'The Easiest and Most Powerful Crypto Wallet',
                        'mid_text' => 'Low Volatility Risk',
                        'last_text' => 'One of the big problems is the volatility of the cryptocurrencies. the blockchain
                        mining provide a minimal risk return proxy.',
                        'image_url' => '/assets/images/img-3.png',
                        'image_width' => '266',
                        'image_height' => '375'
                        ])
                        @include('partials.card-one' ,[
                        'head_text' => 'The Easiest and Most Powerful Crypto Wallet',
                        'mid_text' => 'Minimal Complexity',
                        'last_text' => 'Setting up a mining farm is extremely complex with countless smart contracts, this
                        comes out of the box, pre-installed.',
                        'image_url' => '/assets/images/img-4.png',
                        'image_width' => '375',
                        'image_height' => '238'
                        ])
                        @include('partials.card-one' ,[
                        'head_text' => 'The Easiest and Most Powerful Crypto Wallet',
                        'mid_text' => 'Early Return on Investment (ROI)',
                        'last_text' => 'With a pre-configured mining farm, return on first capital investment occurs in less
                        than 72 hours of first deposit.',
                        'image_url' => '/assets/images/img-5.png',
                        'image_width' => '375',
                        'image_height' => '220'
                        ])
                    </div>
                </div>
            </div>

            <div class="jqlzrh">
                <div class="llRhaW isDesktop">
                    <div class="eZpwdT">
                        <div class="jDwqCc">
                            <div class="ccJpOt">
                                <img src="/assets/images/img-6.png" alt="" class="kQrdDU2 active" width="360" height="542">
                                <img src="/assets/images/img-7.png" alt="" class="kQrdDU2" width="560" height="466">
                                <img src="/assets/images/img-8.png" alt="" class="kQrdDU2" width="357" height="510">
                                <img src="/assets/images/img-9.png" alt="" class="kQrdDU2 iJybLU2" width="782" height="539">
                            </div>
                        </div>
                    </div>
                    <div class="dUizKc wefcrs">
                        <div class="TDzzN eCEsa">
                            <svg width="137" height="32" fill="none">
                                <mask id="a" height="30" maskUnits="userSpaceOnUse" width="30" x="1" y="1">
                                    <rect fill="#c4c4c4" height="28" rx="3" stroke="#f5a250" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" width="28" x="2" y="2"></rect>
                                </mask>
                                <g mask="url(#a)" stroke="#0c6cf2" stroke-width="2">
                                    <g stroke-linecap="round">
                                        <rect fill="#fff" height="28" rx="3" stroke-linejoin="round" width="28" x="2" y="2">
                                        </rect>
                                        <path d="m27 7 3-1v24h-28v-5l3-7 4 1 7-8 7-1z" fill="#0c6cf2" fill-opacity=".36"
                                            stroke-linejoin="round"></path>
                                        <path d="m16 16v14"></path>
                                        <path d="m9 22v8"></path>
                                        <path d="m16 2v4"></path>
                                        <path d="m23 14v16"></path>
                                    </g>
                                    <circle cx="16" cy="11" fill="#fff" r="2"></circle>
                                </g>
                            </svg>
                            <div class="gNGpcW">
                                Exchange
                            </div>
                        </div>

                        <h2 class="iQLqHO">
                            Lightning-Fast Crypto Mining
                        </h2>
                        <div class="eyLHGH">

                            @include('partials.unit-tab' ,[
                            'header' => 'Mine in bitcoin and withdraw in various currecies USD, EUR, and GBP.',
                            'desc' =>'',
                            'class' => 'eHbXX img_dfts2',
                            'text_class' => 'vvWMe hbnAur'
                            ])
                            @include('partials.unit-tab' ,[
                            'header' => 'A matching engine that can keep up with you',
                            'desc' =>'The world’s fastest crypto matching engine, built by and for miners.',
                            'class' => 'eHbXX img_dfts2',
                            'text_class' => 'vvWMe hbnAur'
                            ])
                            @include('partials.unit-tab' ,[
                            'header' => '24/7 live chat support',
                            'desc' =>'Chat with customer support directly in the Exchange, anytime.',
                            'class' => 'eHbXX img_dfts2',
                            'text_class' => 'vvWMe hbnAur'
                            ])
                            @include('partials.unit-tab' ,[
                            'header' => 'Coming soon: NFTs',
                            'desc' =>'Being able to mine and exchange with NFTs.',
                            'class' => 'eHbXX img_dfts2',
                            'text_class' => 'vvWMe hbnAur'
                            ])
                        </div>
                    </div>
                </div>
                <div class="llRhaW isMobile">
                    <div class="slick-carousel  sliderHolder liTytT">
                        @include('partials.card-one' ,[
                        'head_text' => 'The Easiest and Most Powerful Crypto Wallet',
                        'mid_text' => 'Mine in bitcoin and withdraw in various currecies USD, EUR, and GBP.',
                        'last_text' => '',
                        'image_url' => '/assets/images/img-6.png',
                        'image_width' => '230',
                        'image_height' => '375'
                        ])
                        @include('partials.card-one' ,[
                        'head_text' => 'The Easiest and Most Powerful Crypto Wallet',
                        'mid_text' => 'A matching engine that can keep up with you',
                        'last_text' => 'The world’s fastest crypto matching engine, built by and for miners.',
                        'image_url' => '/assets/images/img-7.png',
                        'image_width' => '269',
                        'image_height' => '375'

                        ])
                        @include('partials.card-one' ,[
                        'head_text' => 'The Easiest and Most Powerful Crypto Wallet',
                        'mid_text' => 'Chat with customer support directly in the Exchange, anytime.',
                        'last_text' => 'Chat with customer support directly in the Exchange, anytime.',
                        'image_url' => '/assets/images/img-8.png',
                        'image_width' => '266',
                        'image_height' => '375'
                        ])
                        @include('partials.card-one' ,[
                        'head_text' => 'The Easiest and Most Powerful Crypto Wallet',
                        'mid_text' => 'Coming soon: NFTs',
                        'last_text' => 'Being able to mine and exchange with NFTs.',
                        'image_url' => '/assets/images/img-9.png',
                        'image_width' => '375',
                        'image_height' => '238'
                        ])
                    </div>
                </div>
                <div class="hosPta">
                    <div class="eZpwdT e3rfce">
                        <div class="TDzzN hrbjxUsd">
                            <svg fill="none" height="32" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg">
                                <g stroke="#677185" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path
                                        d="m2.66666 13c-.36818 0-.66666-.2985-.66666-.6667v-2.66663c0-.36819.29848-.66667.66666-.66667h26.66664c.3681 0 .6666.29848.6666.66667v2.66663c0 .3682-.2985.6667-.6666.6667z"
                                        fill="#b1b8c7"></path>
                                    <path
                                        d="m27.9999 8.99998c0-3.99999-5.9999-7.99998-11.9999-7.99998-6.00001 0-12 3.99999-12 7.99998">
                                    </path>
                                    <path
                                        d="m3 27c-.55228 0-1-.4477-1-1v-2c0-.5523.44772-1 1-1h25.9999c.5523 0 1 .4477 1 1v2c0 .5523-.4477 1-1 1z"
                                        fill="#b1b8c7"></path>
                                    <path d="m2 31h27.9999"></path>
                                    <path d="m4 13v10"></path>
                                    <path d="m8 13v10"></path>
                                    <path d="m12 13v10"></path>
                                    <path d="m20 13v10"></path>
                                    <path d="m28 13v10"></path>
                                    <path d="m24 13v10"></path>
                                </g>
                            </svg>
                            <P class="gNGpcW">
                                Institutional
                            </P>
                        </div>

                        <h2 class="kPRcAz iQLqHO">
                            Bespoke crypto mining for individuals and institutions
                        </h2>
                        <p class=" vvWMe hZpocg">
                            Blockchain Remote Mining is a full-stack crypto services platform that works with
                             standard and updated mining technology at an extremely profitable rate.
                        </p>
                        <a href="{{ url('register') }}" class="bWXcPk">Become a client</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="hJQdJu">
        <div class=" jqlzrh eARdfV">
            <h2 class="kPRcAz2 cIzBeK">From zero to crypto in minutes</h2>
            <a href="{{ url('register') }}" class="dwFAru">Get Started</a>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('assets/js/currency.js') }}" defer></script>
@endsection
