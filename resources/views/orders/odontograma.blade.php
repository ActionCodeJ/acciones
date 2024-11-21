@extends('layouts.admin')

@section('title', 'Nuevo Tratamiento')





@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* style.css */

        .container .steps {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .steps .circle {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 50px;
            color: #999;
            font-size: 22px;
            font-weight: 500;
            border-radius: 50%;
            background: #fff;
            border: 4px solid #e0e0e0;
            transition: all 200ms ease;
            transition-delay: 0s;
        }

        .steps .circle.active {
            transition-delay: 100ms;
            border-color: #4070f4;
            color: #4070f4;
            background: #fff;
        }

        .steps .progress-bar {
            position: absolute;
            height: 4px;
            width: 100%;
            background: #4070f4;
            z-index: -0;
            /* ver linea  -1 ocultra*/
        }

        .progress-bar .indicator {
            position: absolute;
            height: 100%;
            width: 0%;
            background: #4070f4;
            transition: all 300ms ease;
        }


        /****/
        .step-wizard {
            background-color: #21d4fd;
            background-image: linear-gradient(19deg, #21d4fd 0%, #b721ff 100%);
            height: 23vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .step-wizard-list {
            background: #fff;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            color: #333;
            list-style-type: none;
            border-radius: 10px;
            display: flex;
            padding: 20px 10px;
            position: relative;
            z-index: 10;
        }

        .step-wizard-item {
            padding: 0 20px;
            flex-basis: 0;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
            min-width: 170px;
            position: relative;
        }

        .step-wizard-item+.step-wizard-item:after {
            content: "";
            position: absolute;
            left: 0;
            top: 19px;
            background: #21d4fd;
            width: 100%;
            height: 2px;
            transform: translateX(-50%);
            z-index: -10;
        }

        .progress-count {
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
            margin: 0 auto;
            position: relative;
            z-index: 10;
            color: transparent;
        }

        .progress-count:after {
            content: "";
            height: 40px;
            width: 40px;
            background: #21d4fd;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            z-index: -10;
        }

        .progress-count:before {
            content: "";
            height: 10px;
            width: 20px;
            border-left: 3px solid #fff;
            border-bottom: 3px solid #fff;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -60%) rotate(-45deg);
            transform-origin: center center;
        }

        .progress-label {
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
        }

        .current-item .progress-count:before,
        .current-item~.step-wizard-item .progress-count:before {
            display: none;
        }

        .current-item~.step-wizard-item .progress-count:after {
            height: 10px;
            width: 10px;
        }

        .current-item~.step-wizard-item .progress-label {
            opacity: 0.5;
        }

        .current-item .progress-count:after {
            background: #fff;
            border: 2px solid #21d4fd;
        }

        .current-item .progress-count {
            color: #21d4fd;
        }

        /**************************/
        /* Faked label styles and icon */


        input[type=file]::file-selector-button {
            margin-right: 1px;
            border: none;
            background: #084cdf;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 10pt;
            /*  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%230964B0'%3E%3Cpath d='M18 15v3H6v-3H4v3c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-3h-2zM7 9l1.41 1.41L11 7.83V16h2V7.83l2.59 2.58L17 9l-5-5-5 5z'/%3E%3C/svg%3E");
        */
            content: 'Select some files';
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #0d45a5;
        }
    </style>
    <!-- start step indicators -->

    <section class="step-wizard">
        <ul class="step-wizard-list">


            <li class="step-wizard-item ">
                <span class="progress-count">3</span>
                <span class="progress-label">Imagenes</span>
            </li>
            <li class="step-wizard-item ">
                <span class="progress-count">4</span>
                <span class="progress-label">Documentacion</span>
            </li>
            <li class="step-wizard-item ">
                <span class="progress-count">5</span>
                <span class="progress-label">Descripcion</span>
            </li>
            <li class="step-wizard-item current-item">
                <span class="progress-count">6</span>
                <span class="progress-label">Odontograma</span>
            </li>
        </ul>
    </section>


    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');
        @import url('https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap');

        body {
            font-family: Google Sans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Fira Sans, Droid Sans, Helvetica Neue, sans-serif;
            background: #f8f9fa;
            color: #212529;
            font-size: 1rem;
            line-height: 1;
        }

        * {
            font-family: Google Sans, Lato, sans-serif;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        .d-flex {
            display: flex !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .w-100 {
            width: 100% !important;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-family: Google Sans, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Fira Sans, Droid Sans, Helvetica Neue, sans-serif;
            height: 100%;
            margin: 0;
            position: relative;
        }

        body {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
            background-color: #fff;
            color: #212529;
            font-family: Open Sans, sans-serif;
            font-size: 1rem;
            height: 100%;
            line-height: 1;
            margin: 0;
            width: 100%;
        }

        html {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
            background-color: #fff;
            color: #212529;
            font-family: Open Sans, sans-serif;
            font-size: 1rem;
            height: 100%;
            line-height: 1;
            margin: 0;
            width: 100%;
        }

        @media (prefers-reduced-motion: no-preference) {
            :root {
                scroll-behavior: smooth;
            }
        }

        .justify-content-around {
            justify-content: space-around !important;
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
        }

        :-webkit-scrollbar {
            height: 10px;
            width: 10px;
        }

        :-webkit-scrollbar-thumb {
            background: #00155c;
            border-radius: 10px;
        }

        :-webkit-scrollbar-thumb:hover {
            background: #00155c;
        }

        :-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .col-5 {
            flex: 0 0 auto;
            width: 41.6666666667%;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .col-4 {
            flex: 0 0 auto;
            width: 33.3333333333%;
        }

        .checkbox-container {
            margin: 50px 0 10px;
        }

        small {
            font-size: .875em;
        }

        .checkboxOverride {
            display: inline-block;
            position: relative;
            width: 25px;
        }

        img {
            vertical-align: middle;
        }

        .img-dientes {
            margin-top: -60px;
            width: 33px;

        }

        input {
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
            margin: 0;
        }

        .teethInput {
            visibility: hidden !important;
        }

        input[type="checkbox"] {
            visibility: visible;
        }

        label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        label {
            display: inline-block;
        }

        .text-center {
            text-align: center !important;
        }

        .checkboxOverride label {
            background: none repeat scroll 0 0 #eee;
            border: 1px solid #ddd;
            cursor: pointer;
            font-size: 12px;
            height: 25px;
            left: 0;
            margin-right: 5px;
            padding-left: 0;
            padding-top: 3px;
            position: absolute;
            top: 0;
            width: 25px;
            z-index: 100;
        }

        .checkboxOverride input[type="checkbox"]:checked+label {
            color: #fff !important;
        }

        .checkboxOverride label::after {

            background: linear-gradient(19deg, #6f42c1 0%, #b721ff 100%);
            content: "";
            height: 17px;
            left: 2.6px;
            opacity: 0;
            position: absolute;
            top: 3px;
            -ms-transform: rotate(-45deg);
            width: 17px;
            z-index: -1;
        }

        .checkboxOverride input[type="checkbox"]:checked+label::after {
            opacity: 1;
        }
    </style>
    <div class="container-fluid">

        <div class="w-100 d-flex justify-content-around snipcss-7RkrD">
            <div class="col-5 d-flex flex-column">
                


                <form action="{{ route('orders.agregarOdontograma', $order) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    @php
                        //  print_r($secciones);
                    @endphp
                    <div class="d-flex justify-content-center">
                        <small class="bg-info text-black font-weight-bold">
                            Odontograma Permanentes <i class="fas fa-tooth" style="font-size:24px;color:white"></i>
                        </small>
                    </div>
                    <div class="mb-3">
                      <label for="DescripcionTextArea" class="form-label" style="color:#f8f9fa">Descripcion</label>
                      <textarea  class="form-control" id="descripcionOdontograma1" name="descripcionOdontograma1" rows="3">{{$order->descripcionOdontograma1}}</textarea>
                    </div>
                    <div class="checkbox-container d-flex justify-content-center">
                        <div class="checkboxOverride">
                            <img style="border: 1px solid #b721ff;background-color:#b721ff;" class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/18_Mesa%20de%20trabajo.png"
                                alt="18">


                            <input {{ in_array(18, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp1" id="SecondcheckboxInputOverrideUp1"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp1">
                                18
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/17_Mesa%20de%20trabajo%201.png"
                                alt="17">
                            <input {{ in_array(17, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp2" id="SecondcheckboxInputOverrideUp2"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp2">
                                17
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/16_Mesa%20de%20trabajo%201.png"
                                alt="16">
                            <input {{ in_array(16, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp3" id="SecondcheckboxInputOverrideUp3"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp3">
                                16
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/15_Mesa%20de%20trabajo%201.png"
                                alt="15">
                            <input {{ in_array(15, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp4" id="SecondcheckboxInputOverrideUp4"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp4">
                                15
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/14_Mesa%20de%20trabajo%201.png"
                                alt="14">
                            <input {{ in_array(14, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp5" id="SecondcheckboxInputOverrideUp5"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp5">
                                14
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/13_Mesa%20de%20trabajo%201.png"
                                alt="13">
                            <input {{ in_array(13, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp6" id="SecondcheckboxInputOverrideUp6"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp6">
                                13
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/12_Mesa%20de%20trabajo%201.png"
                                alt="12">
                            <input {{ in_array(12, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp7" id="SecondcheckboxInputOverrideUp7"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp7">
                                12
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/11_Mesa%20de%20trabajo%201.png"
                                alt="11">
                            <input {{ in_array(11, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp8" id="SecondcheckboxInputOverrideUp8"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp8">
                                11
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/21_Mesa%20de%20trabajo%201.png"
                                alt="21">
                            <input {{ in_array(21, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp9" id="SecondcheckboxInputOverrideUp9"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp9">
                                21
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/22_Mesa%20de%20trabajo%201.png"
                                alt="22">
                            <input {{ in_array(22, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp10" id="SecondcheckboxInputOverrideUp10"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp10">
                                22
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/23_Mesa%20de%20trabajo%201.png"
                                alt="23">
                            <input {{ in_array(23, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp11" id="SecondcheckboxInputOverrideUp11"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp11">
                                23
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/24_Mesa%20de%20trabajo%201.png"
                                alt="24">
                            <input {{ in_array(24, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp12" id="SecondcheckboxInputOverrideUp12"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp12">
                                24
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/25_Mesa%20de%20trabajo%201.png"
                                alt="25">
                            <input {{ in_array(25, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp13" id="SecondcheckboxInputOverrideUp13"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp13">
                                25
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/26_Mesa%20de%20trabajo%201.png"
                                alt="26">
                            <input {{ in_array(26, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp14" id="SecondcheckboxInputOverrideUp14"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp14">
                                26
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/27_Mesa%20de%20trabajo%201.png"
                                alt="27">
                            <input {{ in_array(27, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp15" id="SecondcheckboxInputOverrideUp15"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp15">
                                27
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/28_Mesa%20de%20trabajo%201.png"
                                alt="28">
                            <input {{ in_array(28, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverrideUp16" id="SecondcheckboxInputOverrideUp16"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverrideUp16">
                                28
                            </label>
                        </div>
                    </div>
                    <div class="checkbox-container d-flex justify-content-center">
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/48_Mesa%20de%20trabajo%201.png"
                                alt="48">
                            <input {{ in_array(48, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride1" id="SecondcheckboxInputOverride1"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride1">
                                48
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/47_Mesa%20de%20trabajo%201.png"
                                alt="47">
                            <input {{ in_array(47, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride2" id="SecondcheckboxInputOverride2"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride2">
                                47
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/46_Mesa%20de%20trabajo%201.png"
                                alt="56">
                            <input {{ in_array(46, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride3" id="SecondcheckboxInputOverride3"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride3">
                                46
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/45_Mesa%20de%20trabajo%201.png"
                                alt="45">
                            <input {{ in_array(45, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride4" id="SecondcheckboxInputOverride4"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride4">
                                45
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/44_Mesa%20de%20trabajo%201.png"
                                alt="44">
                            <input {{ in_array(44, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride5" id="SecondcheckboxInputOverride5"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride5">
                                44
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/43_Mesa%20de%20trabajo%201.png"
                                alt="43">
                            <input {{ in_array(43, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride6" id="SecondcheckboxInputOverride6"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride6">
                                43
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/42_Mesa%20de%20trabajo%201.png"
                                alt="42">
                            <input {{ in_array(42, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride7" id="SecondcheckboxInputOverride7"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride7">
                                42
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/41_Mesa%20de%20trabajo%201.png"
                                alt="41">
                            <input {{ in_array(41, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride8" id="SecondcheckboxInputOverride8"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride8">
                                41
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/31_Mesa%20de%20trabajo%201.png"
                                alt="31">
                            <input {{ in_array(31, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride9" id="SecondcheckboxInputOverride9"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride9">
                                31
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/32_Mesa%20de%20trabajo%201.png"
                                alt="32">
                            <input {{ in_array(32, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride10" id="SecondcheckboxInputOverride10"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride10">
                                32
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/33_Mesa%20de%20trabajo%201.png"
                                alt="33">
                            <input {{ in_array(33, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride11" id="SecondcheckboxInputOverride11"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride11">
                                33
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/34_Mesa%20de%20trabajo%201.png"
                                alt="34">
                            <input {{ in_array(34, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride12" id="SecondcheckboxInputOverride12"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride12">
                                34
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/35_Mesa%20de%20trabajo%201.png"
                                alt="35">
                            <input {{ in_array(35, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride13" id="SecondcheckboxInputOverride13"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride13">
                                35
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/36_Mesa%20de%20trabajo%201.png"
                                alt="36">
                            <input {{ in_array(36, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride14" id="SecondcheckboxInputOverride14"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride14">
                                36
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/37_Mesa%20de%20trabajo%201.png"
                                alt="37">
                            <input {{ in_array(37, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride15" id="SecondcheckboxInputOverride15"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride15">
                                37
                            </label>
                        </div>
                        <div class="checkboxOverride">
                            <img class="img-dientes"
                                src="https://new.keepsmiling.click/images/dientes/38_Mesa%20de%20trabajo%201.png"
                                alt="38">
                            <input {{ in_array(38, $secciones) ? 'checked' : '' }} type="checkbox"
                                name="SecondcheckboxInputOverride16" id="SecondcheckboxInputOverride16"
                                class="ls teethInput" value="1">
                            <label class="text-center" for="SecondcheckboxInputOverride16">
                                38
                            </label>
                        </div>
                    </div>
            </div>
            <div class="col-4 d-flex flex-column">
                <div class="d-flex justify-content-center">
                    <small class="bg-info text-black font-weight-bold">
                        Odontograma Temporales<i class="fas fa-tooth" style="font-size:24px;color:white"></i>
                    </small>
                </div>
                <div class="mb-3">
                  <label for="DescripcionTextArea" class="form-label" style="color:#f8f9fa">Descripcion</label>
                  <textarea  class="form-control" id="descripcionOdontograma2" name="descripcionOdontograma2" rows="3">{{$order->descripcionOdontograma2}}</textarea>
                </div>

                <div class="checkbox-container d-flex justify-content-center">
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/17_Mesa%20de%20trabajo%201.png"
                            alt="17">
                        <input {{ in_array(55, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp1Kids" id="SecondcheckboxInputOverrideUp1Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp1Kids">
                            55
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/16_Mesa%20de%20trabajo%201.png"
                            alt="16">
                        <input {{ in_array(54, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp2Kids" id="SecondcheckboxInputOverrideUp2Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp2Kids">
                            54
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/13_Mesa%20de%20trabajo%201.png"
                            alt="13">
                        <input {{ in_array(53, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp3Kids" id="SecondcheckboxInputOverrideUp3Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp3Kids">
                            53
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/12_Mesa%20de%20trabajo%201.png"
                            alt="12">
                        <input {{ in_array(52, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp4Kids" id="SecondcheckboxInputOverrideUp4Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp4Kids">
                            52
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/11_Mesa%20de%20trabajo%201.png"
                            alt="11">
                        <input {{ in_array(51, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp5Kids" id="SecondcheckboxInputOverrideUp5Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp5Kids">
                            51
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/21_Mesa%20de%20trabajo%201.png"
                            alt="21">
                        <input {{ in_array(61, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp6Kids" id="SecondcheckboxInputOverrideUp6Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp6Kids">
                            61
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/22_Mesa%20de%20trabajo%201.png"
                            alt="22">
                        <input {{ in_array(62, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp7Kids" id="SecondcheckboxInputOverrideUp7Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp7Kids">
                            62
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/23_Mesa%20de%20trabajo%201.png"
                            alt="23">
                        <input {{ in_array(63, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp8Kids" id="SecondcheckboxInputOverrideUp8Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp8Kids">
                            63
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/26_Mesa%20de%20trabajo%201.png"
                            alt="26">
                        <input {{ in_array(64, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp9Kids" id="SecondcheckboxInputOverrideUp9Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp9Kids">
                            64
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/27_Mesa%20de%20trabajo%201.png"
                            alt="27">
                        <input {{ in_array(65, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverrideUp10Kids" id="SecondcheckboxInputOverrideUp10Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverrideUp10Kids">
                            65
                        </label>
                    </div>
                </div>
                <div class="checkbox-container d-flex justify-content-center">
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/47_Mesa%20de%20trabajo%201.png"
                            alt="47">
                        <input {{ in_array(85, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride1Kids" id="SecondcheckboxInputOverride1Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride1Kids">
                            85
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/46_Mesa%20de%20trabajo%201.png"
                            alt="46">
                        <input {{ in_array(84, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride2Kids" id="SecondcheckboxInputOverride2Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride2Kids">
                            84
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/43_Mesa%20de%20trabajo%201.png"
                            alt="43">
                        <input {{ in_array(83, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride3Kids" id="SecondcheckboxInputOverride3Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride3Kids">
                            83
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/42_Mesa%20de%20trabajo%201.png"
                            alt="42">
                        <input {{ in_array(82, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride4Kids" id="SecondcheckboxInputOverride4Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride4Kids">
                            82
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/41_Mesa%20de%20trabajo%201.png"
                            alt="41">
                        <input {{ in_array(81, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride5Kids" id="SecondcheckboxInputOverride5Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride5Kids">
                            81
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/31_Mesa%20de%20trabajo%201.png"
                            alt="31">
                        <input {{ in_array(71, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride6Kids" id="SecondcheckboxInputOverride6Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride6Kids">
                            71
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/32_Mesa%20de%20trabajo%201.png"
                            alt="32">
                        <input {{ in_array(72, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride7Kids" id="SecondcheckboxInputOverride7Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride7Kids">
                            72
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/33_Mesa%20de%20trabajo%201.png"
                            alt="33">
                        <input {{ in_array(73, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride8Kids" id="SecondcheckboxInputOverride8Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride8Kids">
                            73
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/36_Mesa%20de%20trabajo%201.png"
                            alt="36">
                        <input {{ in_array(74, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride9Kids" id="SecondcheckboxInputOverride9Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride9Kids">
                            74
                        </label>
                    </div>
                    <div class="checkboxOverride">
                        <img class="img-dientes"
                            src="https://new.keepsmiling.click/images/dientes/37_Mesa%20de%20trabajo%201.png"
                            alt="37">
                        <input {{ in_array(75, $secciones) ? 'checked' : '' }} type="checkbox"
                            name="SecondcheckboxInputOverride10Kids" id="SecondcheckboxInputOverride10Kids"
                            class="ls teethInput" value="1">
                        <label class="text-center" for="SecondcheckboxInputOverride10Kids">
                            75
                        </label>
                    </div>

                </div>

            </div>
        </div>
        <!-- Content Row -->

    </div>
    <div class="card-body">
        <div class="container">
            <button type="submit" style="background-color: #21fdcd;"
                class="btn btn-info btn-block col-md-4 col-lg-4 col-4"> {{ __('Registrar Odontograma') }} <i
                    class="fas fa-tooth" style="font-size:24px;color:white"></i></button>
        </div>
    </div>
    </form>
    <br>
    <br><br><br>


    @if (auth()->user()->rol != 'ADMINISTRADOR')
        <div class="form-group col-lg-12 col-8">

            <a href="{{ route('orders.secciones', $order) }}" class="btn btn-secondary">
                <i class="fa fa-arrow-circle-left" style="font-size:24px;color:white"></i> - Atras</a>


            <a href="{{ route('orders.descripcion', $order) }}" class="btn btn-secondary"> Siguiente -  <i
                    class="fa fa-arrow-circle-right" style="font-size:24px;color:white"></i></a>
        </div>
    @endif
    @if (auth()->user()->rol == 'ADMINISTRADOR')
        <div class="form-group col-lg-12 col-8">

            <a href="{{ route('orders.secciones', $order) }}" class="btn btn-primary">Carga de documentos <i
                    class="	fa fa-file" style="font-size:24px;color:white"></i></a>
            <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Carga de Imagenes <i
                    class="fas fa-image" style="font-size:24px;color:blue"></i></a>


            <a href="{{ route('orders.descripcion', $order) }}" class="btn btn-danger">Descripcion <i
                    class="fas fa-braille" style="font-size:24px;color:white"></i></a>
        </div>
    @endif


@endsection
