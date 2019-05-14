<template>
    <div id="weather" class="d-inline-block">
        <span v-text="cityName"></span>. Температура: <span v-text="currentTemp"></span>;
    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentTemp: null,
                cityName: null
            }
        },
        mounted() {
            let me = this;

            axios.get('/api/weather')
                .then(res => {
                    let data = res.data;
                    if (data.success && data.data) {
                        me.currentTemp = data.data.temp;
                        me.cityName = data.data.name;
                    }
                }).catch(err => {
                console.log(err)
            })
        }
    }
</script>

<style>
    #weather {
        display: inline-block;
    }

</style>
