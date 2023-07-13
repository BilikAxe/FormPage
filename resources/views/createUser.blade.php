<!DOCTYPE html>
<html>
<head>
    <meta charset=UTF-8>
    <title>Контакт</title>
</head>
<body>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<div class="container">
    <form id="contact" action="{{ route('create') }}" method="post">
        @csrf
        <h3>Контакт</h3>
        <fieldset>
            <input placeholder="Имя" type="text" name="first_name" tabindex="1" value="{{ old('first_name') }}" required autofocus>
            @error('first_name')
            <span class='label-text'>{{ $message }}</span>
            @enderror
        </fieldset>
        <fieldset>
            <input placeholder="Фамилия" type="text" name="last_name" tabindex="1" value="{{ old('last_name') }}" required autofocus>
            @error('last_name')
            <span class='label-text'>{{ $message }}</span>
            @enderror
        </fieldset>
        <fieldset>
            <input placeholder="Отчество" type="text" name="surname" tabindex="1" value="{{ old('surname') }}" required autofocus>
            @error('surname')
            <span class='label-text'>{{ $message }}</span>
            @enderror
        </fieldset>
        <fieldset>
            <div class="flatpickr input-group">
                <input type="text" class="flatpickr" placeholder="Дата рождения" id="birthday" name="birthday" value="{{ old('birthday') }}">
                @error('birthday')
                <span class='label-text'>{{ $message }}</span>
                @enderror
            </div>
        </fieldset>
        <fieldset>
            <input placeholder="Телефон" type="tel" name="phone" tabindex="3" value="{{ old('phone') }}" required>
            @error('phone')
            <span class='label-text'>{{ $message }}</span>
            @enderror
        </fieldset>
        <fieldset>
            <input placeholder="Емейл" type="email" name="email" tabindex="2" value="{{ old('email') }}" required>
            @error('email')
            <span class='label-text'>{{ $message }}</span>
            @enderror
        </fieldset>
        <fieldset>
            <textarea placeholder="Коментарий" name="comment" tabindex="5" required></textarea>
            @error('comment')
            <span class='label-text'>{{ $message }}</span>
            @enderror
        </fieldset>
        <fieldset>
            <button type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
        </fieldset>
    </form>
</div>
</body>
</html>
<script>
    flatpickr('#birthday')
</script>

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('#contact').on( 'submit', function(el) {--}}
{{--            el.preventDefault();--}}
{{--            var formData = $(this).serialize();--}}
{{--            $.ajax({--}}
{{--                'method': 'POST',--}}
{{--                'dataType': 'json',--}}
{{--                'url': $(this).attr('action'),--}}
{{--                'data':  formData,--}}
{{--                success: function(data){--}}
{{--                    alert(data.message);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600);

    * {
        margin:0;
        padding:0;
        box-sizing:border-box;
        -webkit-box-sizing:border-box;
        -moz-box-sizing:border-box;
        -webkit-font-smoothing:antialiased;
        -moz-font-smoothing:antialiased;
        -o-font-smoothing:antialiased;
        font-smoothing:antialiased;
        text-rendering:optimizeLegibility;
    }

    body {
        font-family:"Open Sans", Helvetica, Arial, sans-serif;
        font-weight:300;
        font-size: 12px;
        line-height:30px;
        color:#777;
        background:#0CF;
    }

    .container {
        max-width:400px;
        width:100%;
        margin:0 auto;
        position:relative;
    }

    #contact input[type="text"], #contact input[type="email"], #contact input[type="tel"], #contact input[type="url"], #contact textarea, #contact button[type="submit"] { font:400 12px/16px "Open Sans", Helvetica, Arial, sans-serif; }

    #contact {
        background:#F9F9F9;
        padding:25px;
        margin:50px 0;
    }

    #contact h3 {
        margin-bottom: 20px;
        color: #F96;
        display: block;
        font-size: 30px;
        font-weight: 400;
    }

    #contact h4 {
        margin:5px 0 15px;
        display:block;
        font-size:13px;
    }

    fieldset {
        border: medium none !important;
        margin: 0 0 10px;
        min-width: 100%;
        padding: 0;
        width: 100%;
    }

    #contact input[type="text"], #contact input[type="email"], #contact input[type="tel"], #contact input[type="url"], #contact textarea {
        width:100%;
        border:1px solid #CCC;
        background:#FFF;
        margin:0 0 5px;
        padding:10px;
    }

    #contact input[type="text"]:hover, #contact input[type="email"]:hover, #contact input[type="tel"]:hover, #contact input[type="url"]:hover, #contact textarea:hover {
        -webkit-transition:border-color 0.3s ease-in-out;
        -moz-transition:border-color 0.3s ease-in-out;
        transition:border-color 0.3s ease-in-out;
        border:1px solid #AAA;
    }

    #contact textarea {
        height:100px;
        max-width:100%;
        resize:none;
    }

    #contact button[type="submit"] {
        cursor:pointer;
        width:100%;
        border:none;
        background:#0CF;
        color:#FFF;
        margin:0 0 5px;
        padding:10px;
        font-size:15px;
    }

    #contact button[type="submit"]:hover {
        background:#09C;
        -webkit-transition:background 0.3s ease-in-out;
        -moz-transition:background 0.3s ease-in-out;
        transition:background-color 0.3s ease-in-out;
    }

    #contact button[type="submit"]:active { box-shadow:inset 0 1px 3px rgba(0, 0, 0, 0.5); }

    #contact input:focus, #contact textarea:focus {
        outline:0;
        border:1px solid #999;
    }
    ::-webkit-input-placeholder {
        color:#888;
    }
    :-moz-placeholder {
        color:#888;
    }
    ::-moz-placeholder {
        color:#888;
    }
    :-ms-input-placeholder {
        color:#888;
    }

</style>
