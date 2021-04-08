import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function orderReducer(state = initialState.order, action) {
  switch (action.type) {
    case types.ORDER_DATA_SUCCESS:
      return action.order
    default:
      return state
  }
}
