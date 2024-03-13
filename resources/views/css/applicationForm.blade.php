<style>
    body,
    html {
        margin: 0;
        padding: 0;
    }

    .modal {
        margin-top: 5em;
    }

    .fa-solid{
        padding-right: 4px;
    }

    .card-body {
        box-shadow: -1px -1px 57px 22px rgba(0, 0, 0, 0.32);
        -webkit-box-shadow: -1px -1px 57px 22px rgba(0, 0, 0, 0.32);
        -moz-box-shadow: -1px -1px 57px 22px rgba(0, 0, 0, 0.32);
    }

    .form-control:focus {
        background-color: #ffffff;
    }

    body {
        background-size: cover;
        background-attachment: fixed;
        height: auto;
        min-height: 100%;
        width: 100vw;
        margin: 0;
        background-position: 50% 50%;
        background-repeat: no-repeat;
        background-image: url({{ asset('images/bg.jpg') }});
    }

    .select2-container .select2-selection--multiple {
        min-height: 40px;
        max-height: 40px;
        overflow-y: auto;
    }

    .select2-container .select2-selection--multiple .select2-selection__choice {
        margin-top: 2px;
    }

    .text-white {
        filter: drop-shadow(4px 2px 13px rgb(63, 62, 62));
    }

    @media (max-width: 2000px) {
        label {
            font-size: 14px;
            color: whitesmoke;
        }
    }

    @media (max-width: 834px) {
        label {
            font-size: 10px;
            color: whitesmoke;
        }
    }

    img {
        width: 50%;
        height: 120px;
        filter: drop-shadow(4px 2px 13px gray);
    }

    .form-control::placeholder {
        color: gray;
    }

    .js-states::placeholder {
        color: gray;
    }


    .select2-placeholder {
        color: gray;
    }



    .js-states {
        width: 100%;
    }

    /* Data Privacy Notice */
    .privacyNotice {
        margin-left: 10px;
        font-size: 1em;
        color: #fffdfd;
        letter-spacing: 1px;
        font-weight: 300;
    }

    .privacyNotice a {
        color: #fff;
        -webkit-transition: .5s all;
        -moz-transition: .5s all;
        transition: .5s all;
        font-weight: bolder;
        text-decoration: none;
        color: white;
        font-size: large;
    }

    /* Checkbox */
    .wthree-text label {
        font-size: 0.9em;
        color: #fff;
        font-weight: 200;
        cursor: pointer;
        position: relative;
        margin-top: 20px;
    }

    input.checkbox {
        background: #c26f7d;
        cursor: pointer;
        width: 1.2em;
        height: 1.2em;
    }

    input.checkbox:before {
        content: "";
        position: absolute;
        width: 1.2em;
        height: 1.2em;
        background: inherit;
        cursor: pointer;
    }

    input.checkbox:after {
        content: "";
        position: absolute;
        top: 0px;
        left: 0;
        z-index: 1;
        width: 1.2em;
        height: 1.2em;
        border: 1px solid #fff;
        -webkit-transition: .4s ease-in-out;
        -moz-transition: .4s ease-in-out;
        -o-transition: .4s ease-in-out;
        transition: .4s ease-in-out;
    }

    input.checkbox:checked:after {
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
        height: .5rem;
        border-color: #fff;
        border-top-color: transparent;
        border-right-color: transparent;
    }

    .anim input.checkbox:checked:after {
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
        height: .5rem;
        border-color: transparent;
        border-right-color: transparent;
        animation: .4s rippling .4s ease;
        animation-fill-mode: forwards;
    }

    @keyframes rippling {
        50% {
            border-left-color: #fff;
        }

        100% {
            border-bottom-color: #fff;
            border-left-color: #fff;
        }
    }

    h4 {
        /* font-size: 3em; */
        text-align: center;
        color: #fff;
        font-weight: 200px;
        text-transform: capitalize;
        letter-spacing: 4px;
        font-family: "Roboto", sans-serif;
    }

    .form-control,
    .form-select,
    .js-states {
        background-color: #ffffff;
        border-color: rgb(255, 255, 255);
    }

    strong {
        margin-left: 10px;
    }

    .button-container {
        margin: 15px 0;
    }

    .btn {
        width: 100%;
        margin-right: 10px;
        display: block;
        font-size: 20px;
        color: #fff;
        border: none;
        border-radius: 5px;
        background-image: linear-gradient(to right, #aa0707, #ff1c3b);
        cursor: pointer;
        letter-spacing: .2em;
    }

    .btn:hover {
        background-image: linear-gradient(to right, #ff1c3b, #aa0707);
    }

    .is-invalid2 {
        border-color: #dc3545;
    }

    /* Application submitted succesfully */
    .overlay {
        position: fixed;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }

    .alert {
        opacity: 1;
        transition: opacity 1s ease-out;
    }

    .alert.fade-out {
        opacity: 0;
    }

    .alert .icon {
        position: fixed;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        font-size: 40px;
        /* Adjust the size of the icon */
    }
</style>
