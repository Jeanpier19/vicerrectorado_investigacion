<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Passport</div>
                    <div class="card-body">
                        <passport-clients></passport-clients>
												<passport-authorized-clients></passport-authorized-clients>
												<passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            
        }
    }
</script>
