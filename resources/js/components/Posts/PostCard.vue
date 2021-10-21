<template>
  <div class="card my-3">
    <div class="card-header">
      {{ post.title }}
    </div>
    <div class="p-3">
      <p>{{ post.content }}</p>
      <div class="text-right">
        <p>Pubblicato il: {{ getFormattedDate(post.created_at) }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostCard",
  props: ["post"],
  methods: {
    getFormattedDate(date) {
      const postDate = new Date(date);
      let day = postDate.getDate();
      let month = postDate.getMonth() + 1;
      let year = postDate.getFullYear();

      if (day < 10) day = "0" + day;
      if (month < 10) day = "0" + month;

      return `${day}/${month}/${year}`;
    },
  },
};
</script>

<style>
</style>