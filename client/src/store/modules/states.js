
import axios from 'axios';

const state = {
    todos: [
    ],
    comments : [
    ]
};

const getters = {
    allTodos : (state) => state.todos,
    allComments : (state) => state.comments,
};

const actions = {
    async fetchComments({commit} ){
        const test = await axios.get('http://192.168.1.4:8080/api/get_comments');
        commit('setComments',test.data);
    },
    async addComments({commit}, id){
        const response = await axios.post('http://192.168.1.4:8080/api/add_comments', id);
        commit('addComment',response.data);
    },
    async deleteComment({ commit }, id){
        console.log(id);
        const response = await axios.delete('https://jsonplaceholder.typicode.com/todos/${id}');
        commit('setTodos',response);
    },
    async editComment({ commit },id){
        console.log(id);
        console.log(commit);

    },
    async updateTodo({ commit }, updTodo) {
        const response = await axios.put(
          `https://jsonplaceholder.typicode.com/todos/${updTodo.id}`,
          updTodo
        );
        commit('updateTodo', response.data);
      }
};

const mutations = {
    setTodos: (state,todos) => (state.todos = todos),
    setComments: (state,comments) => (state.comments = comments.data),
    newTodo: (state,todos) => (state.todos = todos),
    addComment:(state,new_comments) =>  {
     
      
        console.log(state);

        var test = null;
        for (let [key, value] of Object.entries(new_comments.ids)) {
            console.log("TEST ",key);
            if(test==null){
                test = state.comments["'"+value.parent_id+"'"].sub_comment;
                console.log(test);
            }else{
                test = test.comments["'"+value.parent_id+"'"].sub_comment;
                console.log(test);
            }
        }
    },
    removeTodo:(state,id) =>  {
        state.todos = state.todos.filter(todo => todo.id != id);
    },
    updateTodo: (state, updTodo) => {
        const index = state.todos.findIndex(todo => todo.id === updTodo.id);
        if (index !== -1) {
          state.todos.splice(index, 1, updTodo);
        }
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}