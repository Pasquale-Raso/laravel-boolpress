<template>
  <div id="app">
    <Header />
    <PostList />
  </div>
</template>

<script>
import Header from "./Header.vue";
import PostList from "./Posts/PostList.vue";

export default {
  name: "App",
  data() {},
  components: {
    Header: Header,
    PostList: PostList,
  },
};
</script>
