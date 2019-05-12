<template>
    <div id="weather" class="d-inline-block">
        Температура: <span v-text="currentWeather"></span>;
    </div>
</template>

<script>
  export default {
    data() {
      return {
        currentWeather: null
      }
    },
    mounted() {
      let me = this;

      axios.get('/weather')
        .then(res => {
          let data = res.data;
          if (data.success && data.data) {

            me.currentWeather = data.data.temp;
          }
        }).catch(err => {
        console.log(err)
      })
    }
  }
</script>

<style>
    #weather{
        display: inline-block;
    }

</style>
