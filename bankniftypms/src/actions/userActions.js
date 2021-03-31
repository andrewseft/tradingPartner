import * as types from "./actionsTypes";
import submittingRequestStatus from "./submittingRequestStatusAction";
import * as API from "../utils/apiPath";
import { agent } from "../utils/agent";
import { showToaster, setToaster } from "../utils/helpers";
import { redirect } from "../ui";

export function loginDataSuccess(userInfo) {
  return { type: types.LOADED_USER_INFO_SUCCESS, userInfo };
}

export function RegisterDataSuccess(userInfo) {
  return { type: types.LOADED_USER_REGISTER_SUCCESS, userInfo };
}

export function loadDataSuccess(customerData) {
  return { type: types.LOADED_CUSTOMER_DATA_SUCCESS, customerData };
}

export function loginUserLoginSuccess(isAuth) {
  return { type: types.LOADED_USER_AUTH_SUCCESS, isAuth };
}

export function ParamsDataSuccess(superUserParams) {
  return { type: types.LOADED_USER_PARAM_SUCCESS, superUserParams };
}

export function ForgotPasswordDataSuccess(isFrogot) {
  return { type: types.LOADED_USER_FORGOT_SUCCESS, isFrogot };
}

export function loadViewDataSuccess(updateProfileData) {
  return { type: types.LOADED_UPDATE_PROFILE_SUCCESS, updateProfileData };
}

export function userLoginData(params) {
  return async function (dispatch) {
    dispatch(submittingRequestStatus(true));
    await agent
      .post(API.LOGIN, params)
      .then((response) => {
        if (response.status === 200) {
          dispatch(submittingRequestStatus(false));
          dispatch(loginDataSuccess(response.data.data));
          localStorage.setItem("userToken", response.data.data.api_token);
          dispatch(loginUserLoginSuccess(true));
          if (params.remember_me) {
            dispatch(ParamsDataSuccess(params));
          } else {
            dispatch(ParamsDataSuccess({}));
          }
          dispatch({
            type: "REDIRECT",
            payload: "/manage-profile",
          });
        }
      })
      .catch((error) => {
        showToaster(error.message);
        dispatch(submittingRequestStatus(false));
      });
  };
}

export function userRegisterData(params, roleId) {
  return async function (dispatch) {
    dispatch(submittingRequestStatus(true));
    await agent
      .post(API.REGISTER, params)
      .then((response) => {
        // console.log(response);
        // return false;
        localStorage.setItem("userId", response.data.data);
        if (response.status === 503) {
          showToaster(response.data.message);
          dispatch(submittingRequestStatus(false));
        }
        if (response.status === 200) {
          dispatch(submittingRequestStatus(false));
          dispatch(RegisterDataSuccess(true));
          if (roleId === "Mentor") {
            dispatch({
              type: "REDIRECT",
              payload: "/mentor-signup-step-1",
            });
          }
          if (roleId === "Mentees") {
            dispatch({
              type: "REDIRECT",
              payload: "/mentee-signup-step-1",
            });
          }

          //showToaster(response.data.message);
        }
      })
      .catch((error) => {
        showToaster(error.message);
        dispatch(submittingRequestStatus(false));
      });
  };
}

export function forgotPassword(params) {
  return async function (dispatch) {
    dispatch(submittingRequestStatus(true));
    await agent
      .post(API.FORGOT_PASSWORD, params)
      .then((response) => {
        if (response.status === 200) {
          dispatch(submittingRequestStatus(false));
          dispatch(ForgotPasswordDataSuccess(true));
          showToaster(response.data.message);
        }
      })
      .catch((error) => {
        showToaster(error.message);
        dispatch(submittingRequestStatus(false));
      });
  };
}

export function userLogout(params) {
  return async function (dispatch) {
    dispatch(loginUserLoginSuccess(false));
    dispatch(loginDataSuccess({}));
    localStorage.removeItem("userToken");
  };
}
export const updateProfileData = (params) => async (dispatch) => {
  try {
    dispatch(submittingRequestStatus(true));
    const response = await agent.post(API.UPDATE_PROFILE, params);
    dispatch(submittingRequestStatus(false));
    showToaster(response.data.message);
    //dispatch(updateDataSuccess(response.data.data));
  } catch (error) {
    dispatch(submittingRequestStatus(false));
    showToaster(error.message);
  }
};

export const updatePasswordData = (params) => async (dispatch) => {
  try {
    dispatch(submittingRequestStatus(true));
    const response = await agent.put(
      API.UPDATE_PASSWORD + "/" + params.id,
      params
    );
    dispatch(submittingRequestStatus(false));
    showToaster(response.data.message);
  } catch (error) {
    dispatch(submittingRequestStatus(false));
    showToaster(error.message);
  }
};

export const getUserProfile = (request) => async (dispatch) => {
  try {
    const response = await agent.get(API.GETUSERPROFILE);
    dispatch(loadViewDataSuccess(response.data.data));
  } catch (error) {
    showToaster(error.message);
  }
};

export const updateCustomerData = (params, id, role_id) => async (dispatch) => {
  try {
    const response = await agent.post(
      API.LOAD_CUSTOMER + "/update/" + id,
      params
    );
    dispatch(loadDataSuccess(response.data.data.data));
    setToaster(response.data.message);
  } catch (error) {
    setToaster(error.message);
  }
};

export const updateStep1 = (params, id) => async (dispatch) => {
  try {
    const response = await agent.post(
      API.LOAD_CUSTOMER + "/saveStep1/" + id,
      params
    );
    dispatch(loadDataSuccess(response.data.data.data));
    setToaster(response.data.message);
  } catch (error) {
    setToaster(error.message);
  }
};

export const updateUserAvailability = (params, id) => async (dispatch) => {
  try {
    const response = await agent.post(
      API.LOAD_CUSTOMER + "/updateUserAvailability/" + id,
      params
    );
    dispatch(loadDataSuccess(response.data.data.data));
    setToaster(response.data.message);
  } catch (error) {
    setToaster(error.message);
  }
};

export const updateStep2 = (params, id) => async (dispatch) => {
  try {
    const response = await agent.post(
      API.LOAD_CUSTOMER + "/saveStep2/" + id,
      params
    );
    dispatch(loadDataSuccess(response.data.data.data));
    setToaster(response.data.message);
  } catch (error) {
    setToaster(error.message);
  }
};

export const updateStep3 = (params, id) => async (dispatch) => {
  try {
    const response = await agent.post(
      API.LOAD_CUSTOMER + "/saveStep3/" + id,
      params
    );
    dispatch(loadDataSuccess(response.data.data.data));
    setToaster(response.data.message);
  } catch (error) {
    setToaster(error.message);
  }
};

export const updateStep4 = (params, id) => async (dispatch) => {
  try {
    const response = await agent.post(
      API.LOAD_CUSTOMER + "/saveStep4/" + id,
      params
    );
    dispatch(loadDataSuccess(response.data.data.data));
    setToaster(response.data.message);
  } catch (error) {
    setToaster(error.message);
  }
};
