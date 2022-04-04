
import axios from 'axios';

const state = {
    comments : {
    }
};

const getters = {
    allComments : (state) => state.comments,
};

const actions = {
    async fetchComments({commit} ){
        const comments = await axios.get('http://192.168.1.2:8080/api/get_comments');
        commit('setComments',comments.data);
    },
    async addComments({commit}, id){
        const response = await axios.post('http://192.168.1.2:8080/api/add_comments', id);
        commit('addComment',response.data);
    },
    async deleteComment({ commit }, id){
        commit('deleteComment', id);
    },
    async editComment({ commit },id){
        commit('editComment', id);
    }
};

const mutations = {
    setComments: (state,comments) => (state.comments = comments.data),
    editComment :(state,comment) =>  {
        function findById(state_comments, comment) {
            if (comment.parent_ids.length == 1){ 
                var index = comment.parent_ids.shift();
                state_comments["'"+ index + "'"].comment_desc = comment.edit_comment_desc;
                return {...state_comments};
            }else{
                var element = comment.parent_ids.shift();
                state_comments["'"+ element+ "'"].sub_comment = findById(state_comments["'"+ element+ "'"].sub_comment,  comment);
            }
            return state_comments;
        }
        var new_comment =  JSON.parse(JSON.stringify( comment));
        state.comments = findById(state.comments, new_comment);
    },
    deleteComment:(state,parents_id) =>  {
        function findById(state_comments, parents_id) {
            if (parents_id.length == 1){ 
                var id = parents_id.shift();
                delete state_comments[ "'"+ id + "'"]; 
                return {...state_comments};
            }else{
                var element = parents_id.shift();
                state_comments["'"+ element+ "'"].sub_comment = findById(state_comments["'"+ element+ "'"].sub_comment,  parents_id);
            }
            return state_comments;
        }
        state.comments = findById(state.comments, parents_id);
    },
    addComment:(state,new_comments) =>  {
        function findById(state_comments, new_comment) {
            if (new_comment.ids[0].parent_id === new_comment.ids[0].child_id){ 
                return {
                    ...state_comments,
                    ["'"+ new_comment.id+ "'"] :
                            {
                                comment_by: new_comment.comment_by,
                                comment_desc: new_comment.comment_desc,
                                created_at: new_comment.created_at,
                                id: new_comment.id,
                                sub_comment : {}
                            }                    
                    }; 
                    
            }else{
                var element = new_comment.ids.shift();
                state_comments["'"+ element.parent_id+ "'"].sub_comment = findById(state_comments["'"+ element.parent_id+ "'"].sub_comment,  new_comment);
            }
            return state_comments;
        }
        findById(state.comments, new_comments.data);
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}