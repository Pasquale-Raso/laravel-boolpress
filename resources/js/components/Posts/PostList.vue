<template>
  <div class="container">
    <h2 class="text-center">I miei Post</h2>
    <PostCard v-for="post in posts" :key="post.id" :post="post" />
  </div>
</template>

<script>
import PostCard from "./PostCard.vue";
export default {
  name: "PostList",
  components: {
    PostCard,
  },
  data() {
    return {
      baseUri: "http://127.0.0.1:8000",
      posts: [],
    };
  },
  methods: {
    getPosts() {
      axios
        .get(`${this.baseUri}/api/posts`)
        .then((res) => {
          this.posts = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
  created() {
    this.getPosts();
  },
};
</script>

<style>
</style>