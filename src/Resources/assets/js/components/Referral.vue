<template>
    <div>
        <div>
            <b-button v-b-modal.modal-1>Refer & Earn</b-button>


            <b-modal id="modal-1" title="Refer to your friend:"  ok-title="Share"  @ok="handleOk">
                <div id="app" v-cloak>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-control wizard-form-control d-flex align-items-center testing-code px-20px mb-10px">
                                    <span class="code text-red">{{ testingCode }}</span>
                                    <span class="btn btn-info text-white copy-btn ml-auto" @click.stop.prevent="copyTestingCode">
                                        Copy
                            </span>
                                    <input type="hidden" id="testing-code" :value="testingCode">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <tags-input element-id="tags"
                    v-model="selectedTags"
                    @tag-added="onTagAdded"
                    @tag-removed="onTagRemoved"
                    :typeahead="true"></tags-input>
            </b-modal>
        </div>
    </div>
</template>

<script>
    
    export default {
        data() {
            return {
                testingCode: "",
                emails:[],
                 selectedTags: [
                ]
            }
        },
        mounted() {
            this.getCodeUrl();
        },
        components: {
        },

        methods: {
            //get URL to use to load the code to share
            handleOk(){
                axios.post("/emails", {
                    emails: this.emails.join(',')
                }).then(response => {
                })
                .catch(error => {
                });
            },
            getCodeUrl(){
                axios.get('/generate_referral_code', {
                    headers: {
                        'Accept': 'application/json',
                        'cache-control': 'no-cache'
                    }
                })
                    .then(response => {
                        this.testingCode = response.data;
                    })
                    .catch(response => {
                    });
            },
            copyTestingCode () {
                let testingCodeToCopy = document.querySelector('#testing-code')
                testingCodeToCopy.setAttribute('type', 'text')    // 不是 hidden 才能複製
                testingCodeToCopy.select()

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    alert('Testing code was copied ' + msg);
                } catch (err) {
                    alert('Oops, unable to copy');
                }
                

                /* unselect the range */
                testingCodeToCopy.setAttribute('type', 'hidden')
                window.getSelection().removeAllRanges()
            },
             onTagAdded(slug) {
                 if(!this.emails.find(s=>s.value == slug.value)){
                      this.emails.push(slug.value);
                 }
               
            },

            onTagRemoved(slug) {
                console.log(`Tag removed: ${slug}`);
            },
        }
    }

</script>

