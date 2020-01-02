<template>
   <div>
       <b-jumbotron header-level="4">
        <template  v-slot:header >Point Earned</template>

        <template v-slot:lead>
            {{referrals.point_earned}}
        </template>

        <hr class="my-4">

    </b-jumbotron>
    
    <b-jumbotron>
        <template v-slot:header>Amount Earned</template>

        <template v-slot:lead>
            {{referrals.amount_earned}}
        </template>

        <hr class="my-4">

    </b-jumbotron>
   </div>
</template>
<script>
export default {
     data() {
            return {
                referrals:'',
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
                        this.referrals = response.data;
                    })
                    .catch(response => {
                    });
            }
        }
}
</script>