<template>
  <div>
    <div id="chat">
      <div class="media message-list" v-for="(message, index) in messages">
        <!-- Message delete -->
        <button v-if="user.id === message.user.id" @click="deleteMessage(message.id, index)" class="close pull-right" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <a class="pull-left" :href="'/user/' + message.user.username">
          <div class="avatar-parent">
            <img class="media-object img-responsive img-circle" :alt="message.user.username" :src="message.user.avatarpath">
          </div>
        </a>
        <div class="media-body">
            <h5 class="media-heading">{{ message.user.username }}</h5>
            <p>{{ message.body }}</p>
            <div class="text-muted">
                <small>{{ postedOn(message) }}</small>
            </div>
        </div>
      </div>
    </div>
    <form class="new-message-form" autocomplete="off" @submit.prevent="sendMessage()">
      <!-- Message Form Input -->
      <div class="input-group">
        <input autofocus required v-model="message.body" name="body" class="form-control" type="text">
        <span class="input-group-btn">
          <input type="submit" value="Отправить" class="btn btn-success">
        </span>
      </div>
    </form>
  </div>
</template>

<script>
  import moment from 'moment';

  export default {
    props: ['messagesData', 'thread', 'user'],
    data: function () {
      return {
        messages: this.messagesData,
        message: {
          body: ''
        }
      };
    },
    methods: {
      postedOn(message) {
        moment.locale('ru');
        return moment(message.created_at).fromNow();
      },
      sendMessage() {
        axios.put('/messages/' + this.thread, this.message)
          .then((res) => {
            this.messages.push(res.data);
            this.message.body = '';
          });
      },
      deleteMessage(id, index) {
        axios.delete('/messages/delete/message/' + id);
        this.messages.splice(index, 1);
      }
    },
    mounted() {
      var container = this.$el.querySelector("#chat");
      container.scrollTop = container.scrollHeight;
    },
    updated() {
      var container = this.$el.querySelector("#chat");
      container.scrollTop = container.scrollHeight;
    }
  }
</script>