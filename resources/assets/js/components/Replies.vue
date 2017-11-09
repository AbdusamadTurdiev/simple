<template>
  <div>
    <form class="reply-form" action="#" autocomplete="off" @submit.prevent="createReply()">
      <div class="form-group">
        <div class="input-group input-group-sm">
          <input v-model="reply.body" name="body" autofocus class="form-control" required type="text">
          <span class="input-group-btn">
            <input type="submit" value="Ответить" class="btn btn-success">
          </span>
        </div>
      </div>
    </form>
    <div class="media status-reply" v-for="(reply, index) in replies">
      <a class="pull-left" :href="'/user/' + reply.user.username">
        <div class="avatar-parent">
          <img class="media-object img-responsive img-circle" :alt="reply.user.username" :src="reply.user.avatarpath">
        </div>
      </a>
      <!-- Delete reply -->
        <button v-if="user === reply.user.id" @click="deleteReply(reply.id, index)"
        class="close pull-right" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <!-- End delete -->
      <div class="media-body">
        <h5 class="media-heading">{{ reply.user.username }}</h5>
        <p>{{ reply.body }}</p>
        <ul class="list-inline">
          <li class="text-muted">
            <small>{{ postedOn(reply) }}</small>
          </li>
          <li>
          <favorite :reply="reply"></favorite>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
  import Favorite from './Favorite.vue'
  import moment from 'moment';

  export default {
    props: ['parent', 'user'],
    components: { Favorite },
    data: function () {
      return {
        replies: [],
        reply: {
          body: ''
        }
      };
    },
    mounted() {
      this.fetchReplyList();
    }, 
    methods: {
      postedOn(reply) {
        moment.locale('ru');
        return moment(reply.created_at).fromNow();
      },
      fetchReplyList() {
        axios.get('/status/replies/' + this.parent).then((res) => {
          this.replies = res.data;
        });
      },
      createReply() {
        axios.post('/status/reply/' + this.parent, this.reply)
          .then((res) => {
            this.replies.push(res.data);
            this.reply.body = '';
          });
      },
      deleteReply(id, index) {
        axios.delete('/status/delete/' + id);
        this.replies.splice(index, 1);
      },
    }
  }
</script>