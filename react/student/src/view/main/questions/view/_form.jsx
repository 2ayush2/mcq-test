// @mui material components
import { Grid, Button, TextField } from '@mui/material';
import { Controller } from 'react-hook-form';
import PropTypes from 'prop-types';

const AddForm = ({ control, handleSubmit, onSubmitHandler, isNewItem }) => {
  return (
    <form onSubmit={handleSubmit(onSubmitHandler)}>
      <Grid container spacing={4} direction="row">
        <Grid item lg={12}>
          <Controller
            name="title"
            control={control}
            defaultValue=""
            render={({ field, fieldState }) => {
              return (
                <TextField
                  fullWidth
                  error={Boolean(fieldState.error)}
                  label="Title"
                  defaultValue=""
                  {...field}
                  helperText={fieldState.error?.message}
                />
              );
            }}
          />
        </Grid>
        <Grid item xs={12}>
          <Controller
            name="expiry_date"
            control={control}
            render={({ field, fieldState }) => {
              return (
                <>
                  <TextField
                    fullWidth
                    type="date"
                    format="Y-M-d"
                    InputLabelProps={{
                      shrink: true
                    }}
                    error={Boolean(fieldState.error)}
                    label="Expiry Date"
                    defaultValue=""
                    {...field}
                    helperText={fieldState.error?.message}
                  />
                  {/* <TextField
                    fullWidth
                    error={Boolean(fieldState.error)}
                    label="Expiry Date"
                    defaultValue=""
                    {...field}
                    helperText={fieldState.error?.message}
                  /> */}
                </>
              );
            }}
          />
        </Grid>

        {/* <Grid item xs={9}>
                {errorList}
              </Grid> */}
        <Grid item xs={12}>
          <Button
            variant="contained"
            style={{ float: 'right' }}
            type="submit"
            buttonColor={isNewItem ? 'primary' : 'secondary'}
          >
            {isNewItem ? 'Save' : 'Update'}
          </Button>
        </Grid>
      </Grid>
    </form>
  );
};

AddForm.defaultProps = {
  isNewItem: true
};

AddForm.propTypes = {
  isNewItem: PropTypes.bool,
  control: PropTypes.object.isRequired,
  handleSubmit: PropTypes.func.isRequired,
  onSubmitHandler: PropTypes.func.isRequired
};

export default AddForm;
