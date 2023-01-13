import CheckCircleIcon from '@mui/icons-material/CheckCircle';
import PendingIcon from '@mui/icons-material/Pending';
import ErrorOutlineIcon from '@mui/icons-material/ErrorOutline';

const MailStatus = Object.freeze({
  PENDING: 'p',
  PROCESSING: 'q',
  COMPLETED: 'c'
});

const MailStatusList = {
  [MailStatus.PENDING]: {
    color: 'info',
    icon: <ErrorOutlineIcon sx={{ mr: 1 }} />
  },
  [MailStatus.PROCESSING]: {
    color: 'primary',
    icon: <PendingIcon sx={{ mr: 1 }} />
  },
  [MailStatus.COMPLETED]: {
    color: 'success',
    icon: <CheckCircleIcon sx={{ mr: 1 }} />
  }
};

export { MailStatusList, MailStatus };
