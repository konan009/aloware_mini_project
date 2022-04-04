<template>
  <div class="comment">

    <div v-if="form.edit_flag">
      <input type="text" class="comment_field" v-model="form.edit_comment_desc" >
      <input type="submit" value="Edit" @click="editComments()">
    </div>
    <div v-else>        
      {{ node.comment_desc }} 
      <div class="comment_icon" >
        <span>Comment by: {{ node.comment_by }}</span>&nbsp;
        <span>Created at: {{ node.created_at }}hr</span>&nbsp;
        <i @click="deleteComment( parent_ids )" class="fas fa-trash-alt "></i>&nbsp;
        <i @click="changeBool()" class="fas fa-edit"></i>&nbsp;
      </div>

    </div>
    <div v-if="hasSubcomments">
      <CommentComponent v-for="(child, x) in node.sub_comment" :key="x" :node="child" :parent_ids="appendId(child)"  />
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
    },
  },
  data() {
      return {
          form:{
            comment_desc: '',
            parent_ids: this.parent_ids,
            comment_by : 'Mel',
            edit_comment_desc: this.node.comment_desc,
            edit_flag : false
          }
      }
  },
  methods: {
    ...mapActions(['addComments','deleteComment','editComment']),
    appendId(node) {
      const new_index = [
        ...this.parent_ids,
        node.id
      ];
      return new_index;
    },
    changeBool(){
      this.form.edit_flag = true;
    },
    editComments(){
      this.form.edit_flag = false;
      this.editComment( this.form );
    },
    onSubmit(e){
      e.preventDefault();
      this.addComments( this.form );
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
