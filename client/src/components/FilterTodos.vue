
<template>
  <div>
    Sort By:
    <select @change="filterTodos($event)">
      <option value="asc">Ascending</option>
      <option value="desc">Descending</option>
    </select>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "FilterTodos",
  methods: mapActions(["filterTodos"])
};
</script>

<style scoped>
select {
  margin-top: 20px;
  padding: 6px;
  border: #41b883 1px solid;
}
</style>