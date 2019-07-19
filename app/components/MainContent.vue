<template>
  <div id="main-content">
    <div class="me">
      <p ref="anime" id="anime">{{ resume.description }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'MainContent',
  props: {
    resume: {
      type: Object,
      required: true
    }
  },
  mounted() {
    console.log(this.$refs);
    
    },

}
</script>

<style scoped>
#main-content {
  width: 100vw;
  padding-left: 0;
  margin-left: 0;
}
.me {
  width: 100%;
  height: 90%;
  display: flex;
  align-items: center;
}
p, span {
  font-size: 2.5vw;
  line-height: 4.21875vw;
  letter-spacing: -.4px;
  margin-top: 0;
  color: #4a5568;
  font-family: 'Poppins', sans-serif;
  line-height: 1.8;
  letter-spacing: .01em;
}

/* @media (max-width: 640px) { p,span {font-size:16px; line-height:30px;} } */

.white {
  color:#ffffff;
}

</style>
