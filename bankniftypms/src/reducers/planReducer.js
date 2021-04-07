import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function planReducer(state = initialState.plan, action) {
  switch (action.type) {
    case types.PLAN_DATA_SUCCESS:
      return action.plan
    default:
      return state
  }
}
