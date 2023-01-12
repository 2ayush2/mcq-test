import { ActionTypes } from "../contants/action-types"
const initList = {
    questions: null,
    pg: {
        size: null,
        pages: null,
        current: null,
        total: null
    }
}

export const questionListReducer = (state = initList, { type, payload }) => {
    switch (type) {
        case ActionTypes.QUESTION_LIST:
            return { ...state, ...payload };
        default:
            return state;
    }
}
