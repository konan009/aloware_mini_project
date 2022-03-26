<template>
   <div>
      <h3>Comment Section:</h3>
      <CommentComponent v-for="(node, x)  in allComments" :key="x" :node="node" :parent_ids="[node.id]"/>
   </div>
</template>

<script>
import { mapGetters,mapActions } from 'vuex';
import CommentComponent from "./CommentComponent";

export default {
    name: "TodosView",
    components: {
      CommentComponent
    },
    methods : {
        ...mapActions(['fetchComments','addComments']),
            onSubmit(e){
              e.preventDefault();
              this.addTodo(this.title);
            }
    },
    computed: mapGetters(['allComments']),
    data()  {
        return {
            form:{
              name: '',
            }
        }
    },
    created() {
        this.fetchComments()
    }
}
</script>
<style >
.comment {
  display: block;
  position: relative;
  padding-left: 20px;
}

.comment_by{
  position: absolute;
  bottom: -3px;
  right: 3px;
  font-size: 15px;
  color: #41b883 ;
  cursor: pointer;
}
.todo {
  border: 1px solid #ccc;
  background: #41b883;
  padding: 1rem;
  border-radius: 5px;
  text-align: left;
  position: relative;
  cursor: pointer;
}
i {
  position: absolute;
  bottom: -3px;
  right: 3px;
  color: #fff;
  cursor: pointer;
}
.legend {
  display: flex;
  justify-content: space-around;
  margin-bottom: 1rem;
}
.complete-box {
  display: inline-block;
  width: 10px;
  height: 10px;
  background: #35495e;
}
.incomplete-box {
  display: inline-block;
  width: 10px;
  height: 10px;
  background: #41b883;
}
.is-complete {
  background: #35495e;
  color: #fff;
}
@media (max-width: 500px) {
  .todos {
    grid-template-columns: 1fr;
  }
}
</style>