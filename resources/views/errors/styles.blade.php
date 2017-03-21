
<style>
    body {
        background-color: #385bda;
        color: white;
        font-weight: bold;
        font-family: Roboto,sans-serif;
    }

    .error-wrapper {
        /*min-height: 100%;*/
        position: relative;
        top: 50%;
        transform: translateY(-50%);
    }

    .error-container {
        width: 800px;
        max-width: 90%;
        margin: 0 auto;
        padding-bottom: 30px;
        text-align: center;
    }

    .error-content {
        font-size: 30px;
        text-shadow: 2px 2px rgba(0,0,0,0.4);
    }

    .error-header {
        margin-bottom: 40px;
        color: rgb(200, 240, 255);
        font-size: 50px;
        font-weight: bold;
        text-shadow: 3px 3px rgba(0,0,0,0.4);
    }

    .error-buttons {
        margin-top: 40px;
    }

    .inline-string {
        display: inline-block;
        margin: 10px;
        font-size: 26px;
        color: rgb(200, 240, 255);
        text-shadow: 2px 2px rgba(0,0,0,0.4);
    }

    .btn {
        margin-left: 5px;
        margin-right: 5px;
        -moz-box-shadow:inset 0px -3px 7px 0px #29bbff;
        -webkit-box-shadow:inset 0px -3px 7px 0px #29bbff;
        box-shadow:inset 0px -3px 7px 0px #29bbff;
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2dabf9), color-stop(1, #0688fa));
        background:-moz-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
        background:-webkit-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
        background:-o-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
        background:-ms-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
        background:linear-gradient(to bottom, #2dabf9 5%, #0688fa 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2dabf9', endColorstr='#0688fa',GradientType=0);
        background-color:#2dabf9;
        -moz-border-radius:3px;
        -webkit-border-radius:3px;
        border-radius:5px;
        border:1px solid #049;
        display:inline-block;
        cursor:pointer;
        color:#ffffff;
        font-family:Verdana;
        font-size:18px;
        font-weight:bold;
        padding:9px 23px;
        text-decoration:none;
        text-shadow:0px 1px 0px #263666;
    }
    .btn:hover {
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #0688fa), color-stop(1, #2dabf9));
        background:-moz-linear-gradient(top, #0688fa 5%, #2dabf9 100%);
        background:-webkit-linear-gradient(top, #0688fa 5%, #2dabf9 100%);
        background:-o-linear-gradient(top, #0688fa 5%, #2dabf9 100%);
        background:-ms-linear-gradient(top, #0688fa 5%, #2dabf9 100%);
        background:linear-gradient(to bottom, #0688fa 5%, #2dabf9 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0688fa', endColorstr='#2dabf9',GradientType=0);
        background-color:#0688fa;
    }
    .btn:active {
        position:relative;
        top:1px;
    }

    .bg-gradient {
    }
</style>