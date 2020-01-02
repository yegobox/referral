<template>
    <div>
        hello
    </div>
</template>
<script>
export default {
     data() {
            return {
                referrals:[],
            }
        },
        mounted() {
            this.getReferrals();
        },
        methods: {
           
            getReferrals(){
                axios.get('/referrals', {
                    headers: {
                        'Accept': 'application/json',
                        'cache-control': 'no-cache'
                    }
                })
                    .then(response => {
                        console.log(response);
                    })
                    .catch(response => {
                    });
            }
        }
}
</script>