import React from "react";
import { connect } from "react-redux";

const Index = (props) => {
  const { title, isSubmitting, className } = props;
  return (
    <button className={className} disabled={isSubmitting}>
      {isSubmitting ? (
        <>
          <span
            className="spinner-border spinner-border-sm"
            role="status"
          ></span>{" "}
          Loading...
        </>
      ) : (
        <>{title}</>
      )}
    </button>
  );
};

function mapStateToProps(state) {
  return {
    isSubmitting: state.isSubmitting,
  };
}

export default connect(mapStateToProps)(Index);
