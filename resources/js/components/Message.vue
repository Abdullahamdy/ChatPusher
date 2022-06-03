<template>
<div>
   <li class="list-group-item" :class="ClassName"><slot></slot></li>
    <small class="badge badge-primary float-right" :class="badgeClass"> You </small>
    </div>
</template>

<script>
    export default {
        props:[
            'color',

        ],
        computed:{
            ClassName(){
                return 'list-group-item-'+this.color
            },
             badgeClass(){
                return 'badge-'+this.color
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
