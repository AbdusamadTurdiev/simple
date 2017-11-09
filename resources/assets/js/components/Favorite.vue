<template>
  <button type="submit" :class="classes" @click="toggle">
    <span class="glyphicon glyphicon-heart"></span>
    <span v-text="count"></span>
  </button>
</template>

<script>
  export default {
    props: ['reply'],
    data() {
      return {
        count: this.reply.count,
        active: this.reply.liked
      }
    },
    computed: {
      classes() {
        return [
          'btn btn-xs',
          this.active ? 'btn-primary' : 'btn-default'
        ];
      },
      endpoint() {
        return '/like/' + this.reply.id;
      }
    },
    methods: {
      toggle() {
        this.active ? this.destroy() : this.create();
      },
      create() {
        axios.post(this.endpoint);

        this.active = true;
        this.count++;
      },
      destroy() {
        axios.delete(this.endpoint);

        this.active = false;
        this.count--;
      }
    }
  }
</script>