<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <style>
        body{
            background: #fff;
        }

        .list-group{
            overflow-y: scroll;
            height: 200px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row" id="app">
            <div class="offset-4 col-4" >
                <li class="list-group-item active">Chat Room</li>
                <div class="badge badge-info">@{{typing}}</div>
                <ul class="list-group" v-chat-scroll>
                       <message
                       v-for="value,index in chat.message"
                       :key=value.index
                       :user = chat.user[index]
                       :color = chat.color[index]
                       :time = chat.time[index]
                       >
                           @{{value}}
                       </message>
               </ul>
               <input type="text" class="form-control" v-model="message" placeholder="Type Your Message here ...." @keyup.enter='send'>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
