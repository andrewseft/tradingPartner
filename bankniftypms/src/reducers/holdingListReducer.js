import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function holdingListReducer(
  state = initialState.holdingList,
  action
) {
  switch (action.type) {
    case types.HOLDING_DATA_LIST_SUCCESS:
      return action.holdingList
    default:
      return state
  }
}
