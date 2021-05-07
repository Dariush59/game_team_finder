<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{header}}</div>

                    <div class="card-body">
                       {{msg}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                header: 'Congratulations',
                msg: 'Welcome to our App',
            }
        },
        mounted() {
            console.log('Component beforeCreate.');
            const queries = this.$route.query;
            let formData= JSON.parse(localStorage.getItem('formData'));
            formData.code= queries.code;
            formData.state= queries.state;

            axios
                .post('/api/team-registrations', formData)
                    .then(response => {
                            console.log(response);
                    }).catch( error => {
                        // update page 
                            console.log(error);
                    });

        }
    }
</script>
