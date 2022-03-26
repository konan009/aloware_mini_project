<template>
  <div class="comment">
        {{ node.comment_desc }}
    <div v-if="hasSubcomments">
      <CommentComponent v-for="(child, x) in node.sub_comment" :key="x" :node="child" :parent_ids="appendId(child)" />
    </div>
          <span v-if="parent_ids.length <= 2">
          <form @submit="onSubmit" class="add_comment">
            <input type="text" class="comment_field" v-model="form.comment_desc" placeholder="Reply here..">
            <input type="submit" value="Submit">
          </form>
        </span>
  </div>
</template>
<script>
import { mapActions } from 'vuex';
export default {
  name: 'CommentComponent',
  props: {
    node: {
      type: Object,
      required: true
    },
    parent_ids: {
      type: Array,
      required: true
    }
  },
  data() {
      return {
          form:{
            comment_desc: '',
            parent_ids: this.parent_ids,
            comment_by : 'Mel',
          }
      }
  },
  methods: {
    ...mapActions(['addComments']),
    appendId(node) {
      const new_index = [
        ...this.parent_ids,
        node.id
      ];
      return new_index;
    },
    onSubmit(e){
      e.preventDefault();
      this.addComments(this.form);
    }
  },
  computed: {
    hasSubcomments() {
      const { sub_comment } = this.node
      return typeof sub_comment != "undefined"
    },
  }
}
</script>
