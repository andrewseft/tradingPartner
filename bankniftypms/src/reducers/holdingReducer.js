import * as types from "../actions/actionsTypes"
import initialState from "./initialState"

export default function holdingReducer(state = initialState.holding, action) {
  switch (action.type) {
    case types.HOLDING_DATA_SUCCESS:
      return action.holding
    default:
      return state
  }
}
