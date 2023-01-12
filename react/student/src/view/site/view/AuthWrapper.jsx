import PropTypes from 'prop-types';

// material-ui
import { Box, Grid } from '@mui/material';

// project import
import AuthCard from './AuthCard';

// ==============================|| AUTHENTICATION - WRAPPER ||============================== //

const AuthWrapper = ({ children }) => (
  <Box>
    <Grid
      container
      direction="column"
      justifyContent="flex-end"
      sx={{
        minHeight: '60vh'
      }}
    >
      <Grid
        item
        xs={12}
        container
        justifyContent="center"
        alignItems="center"
        sx={{
          minHeight: { xs: 'calc(100vh - 250px)', md: 'calc(100vh - 200px)' }
        }}
      >
        <Grid item>
          <AuthCard>{children}</AuthCard>
        </Grid>
      </Grid>
    </Grid>
  </Box>
);

AuthWrapper.propTypes = {
  children: PropTypes.node
};

export default AuthWrapper;
