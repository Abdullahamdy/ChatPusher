/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 5000})
Vue.component('message', require('./components/Message.vue').default);
import VueChatScroll from 'vue-chat-scroll';
Vue.use(VueChatScroll);


const app = new Vue({
    el: '#app',
    data:{
        message:'',
        chat:{
            message:[],
            user:[],
            color:[],
            time:[],
        },
        typing : '',
        numberOfUsers:0,

    },

watch:{
    message(){
        Echo.private('chat')
             .whisper('typing', {
               name: this.message
    });
    }

},
    methods:{

        send(){
            if(this.message.length != 0){
            this.chat.message.push(this.message);
            this.chat.color.push('success');
            this.chat.user.push('you');
            this.chat.time.push(this.getTime());


                axios.post('/send', {

                    message :this.message,
                    chat:this.chat,
                  })
                  .then(response => {
                    this.message = '';

                  })
                  .catch(error => {
                     console.log(error);
                  });
            }
        },
        getTime(){
            let time = new Date();
            return time.getHours()+':'+time.getMinutes();
        },
        getOldMessage(){
            axios.post('/getOldMessage')
              .then(response => {
                console.log(response);
                if(response.data != ''){
                    this.chat = response.data;
                }

              })
              .catch(error => {
                 console.log(error);
              });

        },
        deletesession(){
            axios.post('/deletesession')
            .then(response => {
                this.$toaster.success('Chat Deleted Successfully');

            })
        }
    },
    mounted(){
        this.getOldMessage();

        Echo.private('chat')
        .listen('ChatEvent',(e) => {
            this.chat.message.push(e.message);
            this.chat.color.push('warning');
            this.chat.user.push(e.user);
            this.chat.time.push(this.getTime());

            axios.post('/saveToSession', {
                chat:this.chat
              })
              .then(response => {

              })
              .catch(error => {
                 console.log(error);
              });



        })
        .listenForWhisper('typing', (e) => {
            if(e.name != ''){
                this.typing = 'typing ...';

            }else{
                this.typing = '';
            }
        });

        Echo.join('chat')
        .here((users) => {
            this.numberOfUsers = users.length;

        })
        .joining((user) => {

            this.numberOfUsers += 1;
            this.$toaster.success(user.name + 'join in Chat Room');


        })
        .leaving((user) => {
            this.numberOfUsers -= 1;
            this.$toaster.error(user.name + 'is Leave in  Chat Room');

        })
        .error((error) => {
            console.error(error);
        });



    }
});
