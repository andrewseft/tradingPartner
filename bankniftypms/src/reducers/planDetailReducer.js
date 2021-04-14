import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function planDetailReducer(
  state = initialState.planDetail,
  action
) {
  switch (action.type) {
    case types.LOADED_PLAN_DETAIL_DATA_SUCCESS:
      return action.planDetail
    default:
      return state
  }
}
