export interface DataTableHeader {
  title?: string;
  key?: string;
  sortable?: boolean;
  align?: 'start' | 'end' | 'center';
  width?: string | number;
  minWidth?: string;
  maxWidth?: string;
  nowrap?: boolean;
}