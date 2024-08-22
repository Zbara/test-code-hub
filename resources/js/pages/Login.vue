<template>
    <div class="container-tight" style="margin-top: 25vh;">
        <div class="card card-md">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Авторизация</h2>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            headerProps: [{
                breadcrumb: false,
                textBreadcrumb: 'Авторизация',
                nameRoute: 'login',
            }],
        }
    },
    mounted() {
        this.$emit('changeHeaderData', this.headerProps);

        this.submitLoginForm();
    },
    computed: {
        loggedIn() {
            return this.$store.state.auth.status.loggedIn;
        },
    },

    created() {
        if (this.loggedIn) {
            this.$router.push("/");
        }
    },

    methods: {
        submitLoginForm() {
            this.$store.dispatch("auth/login", {
                email: 'admin@test.com',
                password: 'password',
            })
                .then(() => {
                    this.$store.dispatch('user/initUser');

                    this.$router.push({
                        name: "main",
                    });

                }, (error) => {
                    this.message =
                        (error.response &&
                            error.response.data &&
                            error.response.data.messages) ||
                        error.message ||
                        error.toString();
                }
            );
        }
    }
}

</script>
