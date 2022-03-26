<template>
  <div id="app">
    <BlogView/>
    <FilterTodos/>
    <TodosView/>
  </div>
</template>

<script>
import TodosView from './components/TodosView.vue'
import BlogView from './components/BlogView.vue'
import FilterTodos from "./components/FilterTodos.vue";

export default {
  name: 'app',
  components: {
    FilterTodos,
    TodosView,
    BlogView
  }
}
</script>

<style>
body {
  font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
  line-height: 1.6;
  background: #e8f7f0;
}
.container {
  max-width: 1100px;
  margin: auto;
  overflow: auto;
  padding: 0 2rem;
}
</style>
